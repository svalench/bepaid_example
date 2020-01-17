<?php
$url = "https://api.bepaid.by/products";							//url сервиса оплаты
$shop = 'secret_key';												// здесь ваш секретный ключ магазина (должны выдать в bepaid)
$shop_id = 'id_shop';												// здесь ваш id магазина (должны выдать в bepaid)
$name = "название продукта";										// сюда вставляем название продукта который добавляем
$total = 'сюда уже обработанную сумму';								// юда вставляем уже обработанную и нормализованую сумму продукта согласно выбранной валюте
$description = 'описание';											// описание вашего продукта
$test = true;														// маркер о том, что запрос тестовый
$ret_url = 'URL возврата на сайт';									// url страницы вашего сайта куда плательщик перейдет после оплаты
$currency = "BYN";													// берем здесь https://en.wikipedia.org/wiki/ISO_4217

// пример объекта для отправки на сервер bepaid одробно по ссылке https://docs.bepaid.by/ru/gateway/transactions/payment
$data = '{															
  "name":"'.$name.'",
  "description":"'.$description.'",
  "currency":"'.$currency.'",
  "amount":"'.$total.'",
  "infinite":true,
  "visible_fields": null,
  "test":'.$test.',
  "immortal":true,
  "return_url":"'.$ret_url.'",
  "shop_id":"'.$shop_id.'",
  "language":"ru",
  "transaction_type":"payment",
  "product":{
    "shop_id":"'.$shop.'",
    "name":"'.$name.'",
    "description":"'.$description.'",
    "currency":"'.$currency.'",
    "amount":"'.$total.'",
    "infinite":true,
    "return_url":"'.$ret_url.'",
    "language":"ru",
    "immortal":true,
    "transaction_type":"payment",
    "visible_fields": null,
    "test":'.$test.'
  }
}';

// отправляем запрос на сервер bepaid
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));   
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_USERPWD, $shop_id.":".$shop); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch); 
curl_close($ch); 
$res = json_decode($result);
// выводим ответ от сервера
print_r($res);
?>