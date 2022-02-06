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
	private User $user;
	private Product $product;
	private Shoppingcart $shoppingcart;
	private Order $order;

	public function __construct()
	{
		$this->user = new User();
		$this->product = new Product();
		$this->shoppingcart = new Shoppingcart();
		$this->order = new Order();
	}

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
		$result = $this->order->orders_users_products();
		echo "Все заказы:<br>";
		return $this->table($result);
	}

	public function two()
	{
		$result = $this->user->orders_users_shoppingcarts();
		echo "Все заказы, пользователи и корзины:<br>";
		return $this->table($result);
	}

	public function three()
	{
		$result = $this->order->orders_users();
		echo "Все пользователи и сделанные ими заказы:<br>";
		return $this->table($result);
	}

	public function four()
	{
		$result = $this->product->top_five_product();
		echo "Топ 5 дорогих товаров:<br>";
		return $this->table($result);
	}

	public function five()
	{
		$result = $this->product->min_product();
		echo "Товар с минимальной стоимостью:<br>";
		return $this->table($result);
	}

	public function six()
	{
		$result = $this->user->top_user();
		echo "Пользователь сделавший больше всего заказов:<br>";
		return $this->table($result);
	}
}
