<DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
    </head>
    <body>
      <h3 class="head">Заказ с сайта Bikson.ru</h3>
<h4 class="head">Данные покупателя</h4>
<p>ФИО: <span class="head">{{$data['name']}}</span></p>
<p>E-mail: {{$data['email']}}</p>
<p>Город: <span class="head">{{$data['city']}}</span></p>
<p>Контактный телефон: <span class="head">{{$data['phone']}}</span></p>
<p>Состав заказа</p>
<table>
      <thead>
          <tr>
              <th>Товар</th>
              <th>ИнвКод</th>
              <th>Заказ</th>
              <th>Стоимость</th>
          </tr>
      </thead>
      <tbody>
        <?php $cart = $data['cart']; ?>
        <?php $__currentLoopData = $data['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td style="padding:10px"><?php echo e($order_item->title); ?></td>
            <td style="padding:10px"><?php echo e($order_item->inv_code); ?></td>
            <td style="padding:10px">  <?php echo e($order_item->quantity); ?>  шт.</td>
            <td style="padding:10px">  <?php echo e($order_item->price); ?> Р</td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
</table>
<hr>
<p>Итоговая сумма заказа: <span class="head">{{$data['totalPrice']}}</span></p>
    </body>
</html>

<style>
  .head {
    font-weight: bold;
  }
</style>
