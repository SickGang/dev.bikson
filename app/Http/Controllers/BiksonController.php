<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Catalog\Item;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Mail\WelcomeMail;
use App\User;

class BiksonController extends Controller
{
  public function sendMail(Request $request)
  {
    $cart = json_decode(request('cart'));
    $mail = $request->email;
    $data = ([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'city' => $request->city,
      'totalPrice' => $request->totalPrice,
      'cart' => $cart
    ]);

    $order = new Order;
    $order->client_name = $request->name;
    $order->client_email = $request->email;
    $order->client_phone = $request->phone;
    $order->client_city = $request->city;
    $order->save();

    foreach ($cart as $key => $cart_item) {
        $orderItem = new OrderItem;
        $item = (array)$cart_item;
        $orderItem->order_id = $order->id;
        $orderItem->item_id = $item['id'];
        $orderItem->price = $item['price'];
        $orderItem->count = $item['quantity'];
        $orderItem->save();
    }

    Mail::to($mail)->send(new WelcomeMail($data));
  }

  public function getItems(Request $request)
  {
    $name = $request->name;

    if ($name == '') {
      $items = Item::where('hot_news_flag', '1')->get();
    }

    if ($name != '') {
      $items = Item::where('category', $name)->get();
    }

    return $items;
  }

}
