<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use App\Models\User;
use App\Models\Shoppingcart;
use App\Models\Product;

class TestController extends Controller
{
	public function table($data)
	{
		echo "<table border='1' cellspacing='0' width='50%'>";
		echo "<tr>";
		foreach ($data[0] as $key => $value)
		{
			echo "<th>$key</th>";
		}
		echo "</tr>";
		for ($i = 0; $i < count($data); $i++)
		{
			echo "<tr>";
			foreach ($data[$i] as $key => $value)
			{
				echo "<td>$value</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
		echo "<a href='/'>На Главную</a>";
	}

	public function one()
	{
		$AllOrders = Order::select(
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
		echo "Все заказы:<br>";
		return $this->table($AllOrders);
	}

	public function two()
	{
		$orders_users_shoppingcarts = User::select(
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
		echo "Все заказы, пользователи и корзины:<br>";
		return $this->table($orders_users_shoppingcarts);
	}

	public function three()
	{
		$orders_users = Order::select(
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
		echo "Все пользователи и сделанные ими заказы:<br>";
		return $this->table($orders_users);
	}

	public function four()
	{
		$top_five_product = Product::select('*')->orderByDesc('price')->LIMIT(5)->get()->toArray();
		echo "Топ 5 дорогих товаров:<br>";
		return $this->table($top_five_product);
	}

	public function five()
	{
		$min_product = Product::select('*')->where('price', '=', Product::min('price'))->get()->toArray();
		echo "Товар с минимальной стоимостью:<br>";
		return $this->table($min_product);
	}

	public function six()
	{
		$top_user = User::select('users.id', 'users.firstName', 'users.lastName', User::raw("count(*) as 'Количество заказов'"))
			->join('shoppingcarts', 'shoppingcarts.user_id', '=', 'users.id')
			->join('orders', 'orders.shoppingcart_id', '=', 'shoppingcarts.id')
			->groupBy('users.id')
			->orderByDesc('Количество заказов')
			->limit(1)
			->get()->toArray();
		echo "Пользователь сделавший больше всего заказов:<br>";
		return $this->table($top_user);
	}
}
