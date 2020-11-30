<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;

    /**
     * @test
     */
    public function it_should_be_save_sucessfully_user(){
        $response = $this->post('api/register' , ["email" => "foo@bar.com" , "name" => "foo", "password" => "12345"]);
        $response->assertStatus(201);
    }
}
