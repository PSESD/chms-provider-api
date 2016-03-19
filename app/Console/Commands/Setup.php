<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use CHMS\Provider\Models;
use CHMS\Provider\Repositories\User\Contract as UserProvider;
use CHMS\Provider\Repositories\Client\Contract as ClientProvider;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;
use CHMS\Common\Contracts\Acl as AclContract;

class Setup extends Command
{
    protected $signature = 'setup';
    protected $description = 'Set up the dev environment';
    public function handle(
        UserProvider $userProvider,
        RoleProvider $roleProvider,
        ClientProvider $clientProvider,
        AclContract $acl
    ) {

        $client = $clientProvider->find(['name' => 'Test Client']);
        if (empty($client)) {
        	$client = $clientProvider->create([
                'name' => 'Test Client',
                'secret' => 'foobar',
                'type' => 'hub'
            ]);
            $endpoint = new Models\ClientEndpoint;
            $endpoint->redirect_uri = 'http://localhost';
            $client->endpoints()->save($endpoint);
        }
        \dump(['client_id' => $client->id, 'client_secret' => 'foobar']);

        \dump(['role setup', $acl->setupRoles()]);

        $admin = $userProvider->find(['email' => 'admin@example.com']);
        if (empty($admin)) {
        	$admin = $userProvider->create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email'    => 'admin@example.com',
                'password' => 'foobar',
            ]);
            $admin->roles()->save($roleProvider->getRoleBySystemId('super_administrator'));
        }

        $student = $userProvider->find(['email' => 'student@example.com']);
        if (empty($student)) {
        	$student = $userProvider->create([
                'first_name' => 'Student',
                'last_name' => 'User',
                'email'    => 'student@example.com',
                'password' => 'foobar',
            ]);
            $student->roles()->save($roleProvider->getRoleBySystemId('student'));
        }


        $hubAdmin = $userProvider->find(['email' => 'hubadmin@example.com']);
        if (empty($hubAdmin)) {
        	$hubAdmin = $userProvider->create([
                'first_name' => 'Hub',
                'last_name' => 'Admin',
                'email'    => 'hubadmin@example.com',
                'password' => 'foobar',
            ]);
            $hubAdmin->roles()->save($roleProvider->getRoleBySystemId('hub_administrator'));
        }
    }
}
