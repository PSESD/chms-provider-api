<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use CHMS\Common\Auth\UniversalGuard;
use CHMS\SponsorProvider\Repositories\Provider\Contract as ProviderContract;

class PrepareContext
{
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $context = app('context');
        $providerProvider = app(ProviderContract::class);
        $route = $request->route();
        if (!isset($route[2]['providerId'])) {
            return response('Unknown provider.', 404);
        }
        $provider = $providerProvider->find(['slug' => $route[2]['providerId']]);
        if (empty($provider)) {
            return response('Unknown provider.', 404);
        }
        $context->setProviderId($provider->id);
        return $next($request);
    }
}
