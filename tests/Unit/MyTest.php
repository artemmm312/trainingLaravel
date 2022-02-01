<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class MyTest extends TestCase
{
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
