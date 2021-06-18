<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Helpers\ResponseFormatter;
use Validator;

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
            'name' => 'required|max:255',
            'picturePath' => 'required|image',
            'description' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
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

        $food = Food::create($input);

        return ResponseFormatter::success(
            $food,
            'Data list produk berhasil ditambahkan'
        );
    }

    public function show($id){
        $food = Food::find($id);

        if(!($food)){
            return ResponseFormatter::error(
                null,
                'Food tidak ditemukan',
                404 
            );
        }

        return ResponseFormatter::success(
            $food,
            'Data list produk berhasil diambil'
        );
    }

    public function update(Request $request, Food $food){
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'name' => 'required|max:255',
            'description' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
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

        $food->name = $input['name'];
        $food->description = $input['description'];
        $food->ingredients = $input['ingredients'];
        $food->rate = $input['rate'];
        $food->price = $input['price'];
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
        return ResponseFormatter::success(
            null,
            'Data list produk berhasil dihapus'
        );
    }
}
