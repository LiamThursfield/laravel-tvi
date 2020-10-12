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


    protected function signIn(User $user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        return $this;
    }

    protected function signInWithRole(string $role)
    {
        $user = User::factory()->create();
        $user->assignRole($role);

        $this->signIn($user)->actingAs($user);

        return $this;
    }

    protected function signInWithSuperRole()
    {
        return $this->signInWithRole(RoleInterface::SUPER);
    }

    protected function signInWithAdminRole()
    {
        return $this->signInWithRole(RoleInterface::ADMIN);
    }

    protected function signInWithUserRole()
    {
        return $this->signInWithRole(RoleInterface::USER);
    }
}
