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

    /* SELECT * FROM product WHERE price = (SELECT MIN(price) FROM product) */

    /*  use App\Models\Income;

    $incomes = Income::where('amount', '<', function ($query)
    {
        $query->selectRaw('avg(i.amount)')->from('incomes as i');
    })->get(); */
    $min_product = App\Models\Product::select('*')->where('price', '=', function ($query)
    {
        $query->select('*')->min('price');
    })->get()->toArray();
    table($min_product);

    ?>


</body>

</html>