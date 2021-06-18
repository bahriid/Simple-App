<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Food;
use App\Models\Transaction;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    public function testGetFood()
    {
        $this->json('GET', 'api/food', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    
    public function testPostFood()
    {
        $foodData = [
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ];
        $this->json('POST', 'api/food', $foodData)
            ->assertStatus(200);
    }

    public function testPatchFood()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);

        $foodData = [
            "name" => "Kacang3",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ];
        $this->json('PATCH', 'api/food/'. $food->id ,$foodData)
            ->assertStatus(200);
    }

    public function testPutFood()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);

        $foodData = [
            "name" => "Kacang3",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ];
        $this->json('PUT', 'api/food/'. $food->id ,$foodData)
            ->assertStatus(200);
    }

    public function testDeleteFood()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);
        $this->json('DELETE', 'api/food/'. $food->id)
            ->assertStatus(200);
    }

    public function testGetTransaction()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);

        $transaction = Transaction::create([
            "food_id" => 1,
            "quantity" => 100,
            "total" => 2000,
            "status" => "PENDING",
        ]);
        $this->json('GET', 'api/transaction?status=PENDING', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testCheckoutTransaction()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);

        $transaction = [
            "food_id" => 1,
            "quantity" => 10,
            "total" => 2000,
            "status" => "PENDING",
        ];

        $this->json('POST', 'api/checkout', $transaction)
            ->assertStatus(200);
    }

    public function testUpdateTransaction()
    {
        $food = Food::create([
            "name" => "Kacang2",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "ingredients" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price" => 2000,
            "types" => "Vegetables",
            "rate" => 5,
            "quantity" => 100
        ]);

        $transaction = Transaction::create([
            "food_id" => 1,
            "quantity" => 100,
            "total" => 2000,
            "status" => "PENDING",
        ]);

        $transactionData = [
            "status" => "DELIVERED",
        ];

        $this->json('POST', 'api/transaction/'. $transaction['id'], $transactionData)
            ->assertStatus(200);
    }
}
