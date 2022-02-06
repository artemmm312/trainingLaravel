<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'price'];

    public $timestamps = FALSE;

    public function createProduct(string $name, string $price)
    {
        $product = new Product;
        $product->name = "$name";
        $product->price = "$price";
        $product->save();
    }

    public function updateProduct(int $id, string $name, string $price)
    {
        $product = Product::find($id);
        $product->name = "$name";
        $product->price = "$price";
        $product->save();
    }

    public function deleteProduct(int $id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function allProducts(): array
    {
        return  $products = Product::all()->toArray();
    }

    public function top_five_product(): array
    {
        return Product::select('*')->orderByDesc('price')->LIMIT(5)->get()->toArray();
    }

    public function min_product(): array
    {
        return Product::select('*')->where('price', '=', Product::min('price'))->get()->toArray();
    }
}
