<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;
    /**
     * @test
     */
    public function  it_should_receive_token_after_valid_login()
    {
       $user = User::factory()->create(["password" =>  '12345' ]);
        $response = $this->postJson('api/login' , ["email" => $user->email, "password" => '12345']);
        $response->assertStatus(200)
        ->assertJsonStructure(["email","token"]);
    }

    /**
     * @test
     */
    public function it_should_be_receive_message_error_after_invalid_login(){
        $user = User::factory()->create(["password" => "12345"]);
        $response = $this->post("api/login" , ["email" => "$user->email" , "password" => "13245"]);
        $response->assertStatus(401)->assertExactJson(["message" => "credentials are invalid"]);
    }
}
