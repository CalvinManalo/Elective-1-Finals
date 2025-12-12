<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Base test case for the application.
 *
 * The docblock below gives static analyzers hints about the test helpers available
 * on this class so IDEs won't report undefined methods (get, post, actingAs, etc.).
 *
 * @method \Illuminate\Testing\TestResponse get(string $uri, array $headers = [])
 * @method \Illuminate\Testing\TestResponse post(string $uri, array $data = [], array $headers = [])
 * @method \Illuminate\Testing\TestResponse actingAs(\Illuminate\Contracts\Auth\Authenticatable $user)
 * @method void assertAuthenticated()
 * @method void assertGuest()
 * @method void assertDatabaseHas(string $table, array $data)
 */
abstract class TestCase extends BaseTestCase
{
    // includes application bootstrap (CreatesApplication in vendor/pest or app)

    /**
     * Wrapper so static analyzers can find the HTTP helpers.
     * These simply forward to the parent implementations provided by Laravel.
     */
    // (docblock-only annotations above provide static analyzer info; no wrapper methods to avoid signature conflicts)
}
