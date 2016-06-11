<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Http\Controllers;

use CHMS\Common\Http\Controllers\Controller as BaseController;
use CHMS\ProviderHub\Models\Client;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * Handshake controller
 */
class HandshakeController extends BaseController
{
    public function get()
    {
        $providerHub = Client::where(['type' => 'provider_hub'])->first();
        if (empty($providerHub)) {
            return $this->respond(['error' => 'not_set_up'], 400);
        }
        $existingHub = Client::where(['type' => 'central_hub'])->first();
        if (!empty($existingHub)) {
            return $this->respond(['error' => 'already_taken', 'current_hub' => md5($existingHub->id), 'provider_hub_id' => $providerHub->id], 409);
        }
        $expire = time()+10;
        return $this->respond(['token' => Crypt::encrypt('handshake:' . $expire)], 200);
    }

    public function validateToken($token)
    {
        try {
            $token = Crypt::decrypt($token);
        } catch (DecryptException $e) {
            $token = false;
        }
        if (empty($token)) {
            return false;
        }
        $parts = explode(':', $token);
        if (count($parts) !== 2) {
            return false;
        }
        if ($parts[0] !== 'handshake') {
            return false;
        }
        $timecode = (int)$parts[1];
        return $timecode > time();
    }

    public function post(Request $request)
    {
        $providerHub = Client::where(['type' => 'provider_hub'])->first();
        if (empty($providerHub)) {
            return $this->respond(['error' => 'not_set_up'], 400);
        }
        $registerRequest = $request->json()->all();
        if (empty($registerRequest['token']) || !$this->validateToken($registerRequest['token']) || empty($registerRequest['base_url']) || empty($registerRequest['secret']) || empty($registerRequest['id'])) {
            return $this->respond(['error' => 'Bad Request'], 400);
        }
        $client = new Client;
        $client->id = $registerRequest['id'];
        $client->name = 'Central Hub';
        $client->type = 'central_hub';
        $client->base_url = $registerRequest['base_url'];
        $client->secret = $registerRequest['secret'];
        if ($client->save()) {
            return $this->respond(['message' => 'Handshake Complete!', 'provider_hub_id' => $providerHub->id], 200);
        }
        return $this->respond(['error' => 'Error Saving Client'], 500);
    }
}
