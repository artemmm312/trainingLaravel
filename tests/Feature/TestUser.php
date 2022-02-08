<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TestUser extends TestCase
{
    public function test_createUser()
    {
        $user = new User();
        $user->createUser('Алина', 'Лубинец');
        $this->assertModelExists($user);
    }
    public function test_updateUser()
    {
        $user = new User();
        $user->updateUser(24, 'Дмитрий', 'Нагиев');
        $this->assertDatabaseHas('users', [
            'firstName' => 'Дмитрий',
            'lastName' => 'Нагиев',
        ]);
    }
    public function test_deleteUser()
    {
        $user = User::find(25);
        $user->deleteUser();
        $this->assertDeleted($user);
    }
    public function test_allUsers()
    {
        $user = new User();
        $count = count($user->allUsers());
        $this->assertDatabaseCount('users', $count);
    }
}
