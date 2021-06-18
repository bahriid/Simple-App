<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Helpers\ResponseFormatter;
use Validator;
use Illuminate\Support\Facades\Redis;
class FoodController extends Controller
{


    public function index(){
        $food = Food::all();

        return ResponseFormatter::success(
            $food,
            'Data list produk berhasil diambil'
        );
    }

    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'name' => 'max:255',
            'description' => '',
            'ingredients' => '',
            'price' => 'integer',
            'quantity' => 'integer',
            'rate' => 'integer',
            'types' => '',
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(
                null,
                $validator->errors(),
                400 
            );
        }

        $food = Food::create($input);
        Redis::flushDB();
        return ResponseFormatter::success(
            $food,
            'Data list produk berhasil ditambahkan'
        );
    }

    public function show($id){
        $cachedFood = Redis::get('food_' . $id);
        
        if(isset($cachedFood)) {
            $food = json_decode($cachedFood, FALSE);

            return ResponseFormatter::success([
                $food,
                'Fetched from redis'
            ]);
            
        }else{
            $food = Food::find($id);
            Redis::set('food_' . $id, $food);
        
            return ResponseFormatter::success([
                $food,
                'Fetched from database'
            ]);
            

        }
    }

    public function update(Request $request, Food $food){
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'name' => 'required|max:255',
            'description' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'rate' => 'required|integer',
            'types' => '',
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(
                null,
                $validator->errors(),
                400 
            );
        }
        Redis::del('food_' . $food['id']);

        $food->name = $input['name'];
        $food->description = $input['description'];
        $food->ingredients = $input['ingredients'];
        $food->rate = $input['rate'];
        $food->price = $input['price'];
        $food->quantity = $input['quantity'];
        $food->types = $input['types'];
        $food->save();

        return ResponseFormatter::success(
            $food,
            'Data list produk berhasil diedit'
        );
    }

    public function destroy(Food $food)
    {
        $food->delete();
        Redis::del('food_' . $food['id']);
        return ResponseFormatter::success(
            null,
            'Data list produk berhasil dihapus'
        );
    }
}
