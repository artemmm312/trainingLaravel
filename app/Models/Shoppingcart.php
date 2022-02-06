<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'product_id'];

    public $timestamps = FALSE;

    public function createShoppingcart(string $user_id, string $product_id)
    {
        $product = new Shoppingcart;
        $product->user_id = "$user_id";
        $product->product_id = "$product_id";
        $product->save();
    }

    public function updateShoppingcart(int $id, string $user_id, string $product_id)
    {
        $product = Shoppingcart::find($id);
        $product->user_id = "$user_id";
        $product->product_id = "$product_id";
        $product->save();
    }

    public function deleteShoppingcart(int $id)
    {
        $product = Shoppingcart::find($id);
        $product->delete();
    }

    public function allShoppingcarts(): array
    {
        return  $shoppingcarts = Shoppingcart::all()->toArray();
    }
}
