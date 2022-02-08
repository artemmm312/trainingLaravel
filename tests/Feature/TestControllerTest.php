<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testZero()
    {
        $response = $this->get('/');
        //dd($response->getContent());
        $response->assertOk();
    }

    public function testOne()
    {
        $response = $this->get('/1');
        $response->assertOk();
    }

    public function testTwo()
    {
        $response = $this->get('/2');
        $response->assertOk();
    }

    public function testThree()
    {
        $response = $this->get('/3');
        $response->assertOk();
    }

    public function testFour()
    {
        $response = $this->get('/4');
        $response->assertOk();
    }

    public function testFive()
    {
        $response = $this->get('/5');
        $response->assertOk();
    }
    public function testSix()
    {
        $response = $this->get('/6');
        $response->assertOk();
    }
}
