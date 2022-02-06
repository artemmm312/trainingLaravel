<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'shoppingcarts_id', 'date'];

    public $timestamps = FALSE;

    public function createOrder(string $shoppingcart_id, DateTime $date)
    {
        $product = new Order;
        $product->shoppingcart_id = "$shoppingcart_id";
        $product->date = "$date";
        $product->save();
    }

    public function updateOrder(int $id, string $shoppingcart_id, DateTime $date)
    {
        $product = Order::find($id);
        $product->shoppingcart_id = "$shoppingcart_id";
        $product->date = "$date";
        $product->save();
    }

    public function deleteOrder(int $id)
    {
        $product = Order::find($id);
        $product->delete();
    }

    public function allOrders(): array
    {
        return  $orders = Order::all()->toArray();
    }

    public function orders_users_products()
    {
        return Order::select(
            'orders.id as id заказа',
            'orders.date as Дата заказа',
            'users.firstName as Имя',
            'users.lastName as Фамилия',
            'products.id as id продукта',
            'products.name as Наименование продукта',
            'products.price as Цена'
        )
            ->join('shoppingcarts', 'shoppingcarts.id', '=', 'orders.shoppingcart_id')
            ->join('users', 'shoppingcarts.user_id', '=', 'users.id')
            ->join('products', 'shoppingcarts.product_id', '=', 'products.id')
            ->get()->toArray();
    }

    public function orders_users(): array
    {
        return Order::select(
            'orders.id as id заказа',
            'orders.date as Дата заказа',
            'users.id as id Пользователя',
            'users.firstName as Имя',
            'users.lastName as Фамилия',
            'products.id as id продукта',
            'products.name as Наименование продукта',
            'products.price as Цена'
        )
            ->leftJoin('shoppingcarts', 'shoppingcarts.id', '=', 'orders.shoppingCart_id')
            ->rightJoin('users', 'shoppingcarts.user_id', '=', 'users.id')
            ->leftJoin('products', 'shoppingcarts.product_id', '=', 'products.id')
            ->get()->toArray();
    }
}
