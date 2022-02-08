<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'firstName', 'lastName'];

    public $timestamps = FALSE;

    public function createUser(string $firstName, string $lastName)
    {
        $user = new User;
        $user->firstName = "$firstName";
        $user->lastName = "$lastName";
        $user->save();
    }

    public function updateUser(int $id, string $firstName, string $lastName)
    {
        $user = User::find($id);
        $user->firstName = "$firstName";
        $user->lastName = "$lastName";
        $user->save();
    }

    public function deleteUser(int $id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function allUsers(): array
    {
        return User::all()->toArray();
    }

    public function orders_users_shoppingcarts(): array
    {
        return User::select(
            'orders.id as id заказа',
            'orders.date as Дата заказа',
            'users.firstName as Имя',
            'users.lastName as Фамилия',
            'products.id as id продукта',
            'products.name as Наименование продукта',
            'products.price as Цена'
        )
            ->leftJoin('shoppingcarts', 'shoppingcarts.user_id', '=', 'users.id')
            ->leftJoin('orders', 'shoppingcarts.id', '=', 'orders.shoppingCart_id')
            ->leftJoin('products', 'shoppingcarts.product_id', '=', 'products.id')
            ->get()->toArray();
    }

    public function top_user(): array
    {
        return User::select('users.id', 'users.firstName', 'users.lastName', User::raw("count(*) as 'Количество заказов'"))
            ->join('shoppingcarts', 'shoppingcarts.user_id', '=', 'users.id')
            ->join('orders', 'orders.shoppingcart_id', '=', 'shoppingcarts.id')
            ->groupBy('users.id')
            ->orderByDesc('Количество заказов')
            ->limit(1)
            ->get()->toArray();
    }
}
