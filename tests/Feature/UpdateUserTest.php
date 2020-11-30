<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;
    /**
     * @test
     */
     public function  it_should_receive_valid_user_and_update(){
         $user = User::factory()->create();
         Sanctum::actingAs(
             $user,
             ["seila"]
         );

         $response = $this->put('api/user' , ["user" => "$user->id","email" => "vinnyaoe@gmail.com" , "name" => "Vinicius" , "password" => "12345"]);
         $response->assertExactJson( ["email" => "vinnyaoe@gmail.com" ,
             "name" => "Vinicius" ]);
     }
}
