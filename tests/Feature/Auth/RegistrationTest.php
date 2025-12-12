<?php
// @phpstan-ignore-file -- test helpers are provided by the framework and Pest; suppress static analysis here

test('registration screen can be rendered', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('registration screen can be rendered for a selected role', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->get(route('register', ['role' => 'student']));

    $response->assertStatus(200);
});

test('new users can register for a selected role and role is persisted', function () {
    /** @var \Tests\TestCase $this */
    $email = 'roleuser@example.com';

    $response = $this->post(route('register', ['role' => 'student']), [
        'name' => 'Role User',
        'email' => $email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', ['email' => $email, 'role' => 'student']);
    $response->assertRedirect(route('dashboard', absolute: false));
});
