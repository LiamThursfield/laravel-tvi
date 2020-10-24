<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

abstract class AbstractAdminTestCase extends TestCase
{

    /**
     * Ensure a route can only be accessed by signed in users with the correct permissions
     *
     * @param string $route
     * @param string $method - the request method (get, post, etc.)
     * @return $this;
     */
    protected function assertIsPermissionAuthenticatedRoute(string $route, $method = 'get')
    {
        // Ensure Guests are redirected to the login page
        $response = $this->call($method, $route);
        $response->assertRedirect(route('login'));

        // Ensure users without permission to the route get a Forbidden response
        $response = $this->signIn()->call($method, $route);
        $response->assertStatus(403);

        return $this;
    }
}
