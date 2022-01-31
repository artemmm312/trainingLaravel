<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

<body>
    <?php

    use Illuminate\Support\Facades\DB;
    use App\Models\User;

    function table($data)
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
    };

    $AllOrders = App\Models\Order::select(
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
    table($AllOrders);

    $orders_users_shoppingcarts = App\Models\User::select(
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
    table($orders_users_shoppingcarts);

    $orders_users = App\Models\Order::select(
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
    table($orders_users);

    $top_five_product = App\Models\Product::select('*')->orderByDesc('price')->LIMIT(5)->get()->toArray();
    echo "Топ 5 дорогих товаров:<br>";
    table($top_five_product);

    $min_product = App\Models\Product::select('*')->where('price', '=', App\Models\Product::min('price'))->get()->toArray();
    echo "Товар с минимальной стоимостью:<br>";
    table($min_product);

    /* "SELECT user.id, user.firstName, user.lastName, COUNT(*) AS `Количество заказов` 
	FROM user 
	JOIN shoppingcart ON shoppingcart.userID = user.id 
	JOIN `order` ON `order`.shopcartID = shoppingcart.id 
	GROUP BY user.id
	ORDER BY `Количество заказов` DESC 
	LIMIT 1" */

    $top_user = App\Models\User::select('users.id', 'users.firstName', 'users.lastName', User::raw('count(*) as num'))
        ->join('shoppingcarts', 'shoppingcarts.user_id', '=', 'users.id')
        ->join('orders', 'orders.shoppingcart_id', '=', 'shoppingcarts.id')
        ->groupBy('users.id')
        ->orderByDesc('num')
        ->limit(1)
        ->get()->toArray();
    var_dump($top_user);
    ?>


</body>

</html>