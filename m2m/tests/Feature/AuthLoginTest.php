<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;


    public function testLoginReturnsTokenOnValidCredentials(){

        $user = User::factory()->create([
            'email' => 'matsdev@example.com',
            'password' => Hash::make('secretPassword'),
        ]);

        $req = $this->postJson('/api/login',[
            'email' => 'matsdev@example.com',
            'password' => 'secretPassword',
        ]);

        $req->assertOk()->assertJsonStructure(['token']);
    }

    public function testLoginFailsOnInvalidCrendtials(){
        $req = $this->postJson('/api/login', [
            'email' => 'matsdev@example.com',
            'password' => 'wrongPassword',
        ]);
        
        $req->assertStatus(401);
    }


}