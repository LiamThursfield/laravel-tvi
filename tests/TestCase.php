<?php

namespace Tests;

use App\Interfaces\RoleInterface;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Assert;

/**
 * Class TestCase
 * @package Tests
 *
 * Inertia specific assertion methods
 * @method $this assertHasProp($key)
 * @method $this assertPropCount($key, $count)
 * @method $this assertPropValue($key, $value)
 * @method array props($key)
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DatabaseMigrations,
        DatabaseTransactions;

    /**
     * @var Faker
     */
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->inertiaSetup();
        $this->faker = Faker::create();
    }

    protected function tearDown(): void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }

    /**
     * Define the Inertia specific assertions.
     * Taken from: https://github.com/inertiajs/pingcrm/blob/master/tests/TestCase.php
     */
    protected function inertiaSetup(): void {
        TestResponse::macro('props', function ($key = null) {
            $props = json_decode(json_encode($this->original->getData()['page']['props']), JSON_OBJECT_AS_ARRAY);

            if ($key) {
                return Arr::get($props, $key);
            }

            return $props;
        });

        TestResponse::macro('assertHasProp', function ($key) {
            Assert::assertTrue(Arr::has($this->props(), $key));

            return $this;
        });

        TestResponse::macro('assertPropValue', function ($key, $value) {
            $this->assertHasProp($key);

            if (is_callable($value)) {
                $value($this->props($key));
            } else {
                Assert::assertEquals($this->props($key), $value);
            }

            return $this;
        });

        TestResponse::macro('assertPropCount', function ($key, $count) {
            $this->assertHasProp($key);

            Assert::assertCount($count, $this->props($key));

            return $this;
        });
    }


    /**
     * Sign in with a user
     * @param User|null $user
     * @return $this
     */
    protected function signIn(User $user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        // Navigating to admin ensures that any 'redirect back' go to admin index instead of web index
        // Going to web index causes issues when following redirects and web routes are not disabled
        // As an additional redirect to admin causes any shared data to be lost from the response
        $this->get(route('admin.index'));

        return $this;
    }

    /**
     * Sign in with a user and give the provided permission(s).
     * @param string|array $permissions
     * @param User|null $user
     * @return $this
     */
    protected function signInWithPermissions($permissions, User $user = null)
    {
        $user = $user ?: User::factory()->create();
        $user->givePermissionTo($permissions);

        return $this->signIn($user);
    }


    /**
     * Sign in with a user and assign the provided role.
     * @param string $role
     * @param User|null $user
     * @return $this
     */
    protected function signInWithRole(string $role, User $user = null)
    {
        $user = $user ?: User::factory()->create();
        $user->assignRole($role);

        return $this->signIn($user);
    }

    /**
     * Sign in with a user and assign the Super role.
     * @param User|null $user
     * @return $this
     */
    protected function signInWithSuperRole(User $user = null)
    {
        return $this->signInWithRole(RoleInterface::SUPER, $user);
    }

    /**
     * Sign in with a user and assign the Admin role.
     * @param User|null $user
     * @return $this
     */
    protected function signInWithAdminRole(User $user = null)
    {
        return $this->signInWithRole(RoleInterface::ADMIN, $user);
    }

    /**
     * Sign in with a user and assign the Super role.
     * @param User|null $user
     * @return $this
     */
    protected function signInWithUserRole(User $user = null)
    {
        return $this->signInWithRole(RoleInterface::USER, $user);
    }
}
