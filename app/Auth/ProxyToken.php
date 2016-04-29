<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Auth;
use CHMS\SponsorProvider\Models\User;
use CHMS\SponsorProvider\Models\Client;

class ProxyToken
{
    private $token;
    private $id;
    private $type;
    private $expires;
    private $isSuperAdmin = false;
    private $meta = [];

    /**
     * Generate object
     * @param  string $token
     * @param  array $raw
     * @return static|boolean
     */
    public static function generate($token, $raw)
    {
        if (!isset($raw['id']) || !isset($raw['type']) || !isset($raw['meta']) || !isset($raw['expires'])) {
            return false;
        }
        return new static($token, $raw);
    }

    /**
     * Constructor
     * @param string $token
     * @param string $type
     * @param string $id
     * @param int $expires
     * @param array $meta
     */
    public function __construct($token, $raw)
    {
        $this->token = $token;
        $this->id = $raw['id'];
        $this->type = $raw['type'];
        $this->meta = isset($raw['meta']) ? $raw['meta'] : [];
        $this->isSuperAdmin = isset($raw['is_super_admin']) ? $raw['is_super_admin'] : false;
        $this->expires = $raw['expires'];
    }

    /**
     * Gets the id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets the meta
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Gets the expires time
     * @return int
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Gets the token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Ensures the client or user is in the system
     *
     * @return boolean
     */
    public function ensureObject()
    {
        if ($this->type === 'user') {
            $result = User::ensure($this->id);
            if ($result) {
                $context = app('context');
                if ($context->getProviderId()) {
                    $result = User::ensureRole($this->id, ['student'], $context->getProviderId());
                }
                if ($this->isSuperAdmin) {
                    $result = $result && User::ensureRole($this->id, ['super_administrator']);
                }
            }
            return $result;
        } elseif ($this->type === 'client') {
            return Client::ensure($this->id);
        }
        return false;
    }
}
