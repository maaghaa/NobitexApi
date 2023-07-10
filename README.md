Here is a possible README for this class:

# Nobitex API PHP Class

This class provides a simple way to interact with the Nobitex API using PHP. You can use this class to perform various operations such as getting market data, placing orders, managing your wallet, and trading with margin.

## Requirements

- PHP 7.0 or higher
- cURL extension enabled
- A Nobitex account and API token

## Installation

You can install this class using composer:

```shell
composer require maaghaa/NobitexApi
```

Or you can download the nobitex.php file and include it in your project:

```php
require_once 'nobitex.php';
```

## Usage

To use this class, you need to create an instance of the Nobitex class and pass your API token as a parameter:

```php
$nobitex = new Nobitex('yourTOKENhereHEX0000000000');
```

Then you can call the available methods on the $nobitex object. For example, to get the latest market statistics, you can use the global_market_statistics method:

```php
$response = $nobitex->global_market_statistics();
if ($response) {
  // Do something with the response array
  print_r($response);
} else {
  // Handle the error
  echo "Something went wrong";
}
```

To register a new order, you can use the register_new_order method and pass the required parameters:

```php
$response = $nobitex->register_new_order('buy', 'btc', 'rls', '0.6', '520000000', 'order1');
if ($response) {
  // Do something with the order array
  print_r($response);
} else {
  // Handle the error
  echo "Something went wrong";
}
```

To get the user profile, you can use the user_profile method:

```php
$response = $nobitex->user_profile();
if ($response) {
  // Do something with the profile array
  print_r($response);
} else {
  // Handle the error
  echo "Something went wrong";
}
```

## Available Methods

The following methods are available in this class:

- global_market_statistics: Get the latest global market statistics.
- orderbook_v2: Get the list of orders or orderbook for different markets.
- register_new_order: Register a new order.
- order_status: Get the order status.
- user_orders: Get the user orders.
- change_order_status: Change the order status.
- user_trades_list: Get the user trades list.
- user_profile: Get the user profile.
- user_wallets_list: Get the user wallets list.
- wallet_balance: Get the wallet balance.
- transactions_list: Get the transactions list.
- register_withdrawal: Register a withdrawal request.
- margin_markets_list: Get the margin markets list.
- add_margin_sell_order: Add a margin sell order.
- positions_list: Get the positions list.
- position_status: View a position status.
- close_margin_sell_position: Close a margin sell position.

For more details on each method, please refer to the comments in the nobitex.php file or visit https://apidocs.nobitex.ir/ for the official API documentation.




# کلاس PHP نوبیتکس

این کلاس یک راه ساده برای ارتباط با API نوبیتکس با استفاده از PHP فراهم می‌کند. شما می‌توانید از این کلاس برای انجام عملیات‌های مختلفی مانند دریافت داده‌های بازار، ثبت سفارش، مدیریت کیف پول و معاملات فروش تعهدی استفاده کنید.

## نیازمندی‌ها

- PHP 7.0 یا بالاتر
- فعال بودن افزونه cURL
- یک حساب کاربری و توکن API نوبیتکس

## نصب

شما می‌توانید این کلاس را با استفاده از composer نصب کنید:

```shell
composer require maaghaa/NobitexApi
```

یا می‌توانید فایل nobitex.php را دانلود کرده و در پروژه خود قرار دهید:

```php
require_once 'nobitex.php';
```

## استفاده

برای استفاده از این کلاس، شما باید یک نمونه از کلاس Nobitex ایجاد کنید و توکن API خود را به عنوان پارامتر بدهید:

```php
$nobitex = new Nobitex('yourTOKENhereHEX0000000000');
```

سپس می‌توانید از متدهای موجود روی شئ $nobitex فراخوانی کنید. به عنوان مثال، برای دریافت آخرین آمار بازار، می‌توانید از متد global_market_statistics استفاده کنید:

```php
$response = $nobitex->global_market_statistics();
if ($response) {
  // با آرایه پاسخ کاری انجام دهید
  print_r($response);
} else {
  // خطا را رسیدگی کنید
  echo "مشکلی پیش آمده است";
}
```

برای ثبت سفارش جدید، می‌توانید از متد register_new_order استفاده کنید و پارامتر‌های لازم را بدهید:

```php
$response = $nobitex->register_new_order('buy', 'btc', 'rls', '0.6', '520000000', 'order1');
if ($response) {
  // با آرایه سفارش کاری انجام دهید
  print_r($response);
} else {
  // خطا را رسیدگی کنید
  echo "مشکلی پیش آمده است";
}
```

برای دریافت پروفایل کاربر، می‌توانید از متد user_profile استفاده کنید:

```php
$response = $nobitex->user_profile();
if ($response) {
  // با آرایه پروفایل کاری انجام دهید
  print_r($response);
} else {
  // خطا را رسیدگی کنید
  echo "مشکلی پیش آمده است";
}
```

## متدهای موجود

متدهای زیر در این کلاس قابل استفاده هستند:

- global_market_statistics: دریافت آخرین آمار بازار جهانی.
- orderbook_v2: دریافت لیست سفارش‌ها یا همان اردربوک بازارهای مختلف.
- register_new_order: ثبت سفارش جدید.
- order_status: دریافت وضعیت سفارش.
- user_orders: دریافت سفارش‌های کاربر.
- change_order_status: تغییر وضعیت سفارش.
- user_trades_list: دریافت لیست معاملات کاربر.
- user_profile: دریافت پروفایل کاربر.
- user_wallets_list: دریافت لیست کیف پول‌های کاربر.
- wallet_balance: دریافت موجودی کیف پول.
- transactions_list: دریافت لیست تراکنش‌ها.
- register_withdrawal: ثبت درخواست برداشت.
- margin_markets_list: دریافت لیست بازارهای پشتیبانی شده برای معاملات فروش تعهدی.
- add_margin_sell_order: ثبت سفارش فروش تعهدی.
- positions_list: دریافت لیست موقعیت‌های باز و تاریخچه موقعیت‌های پایان یافته.
- position_status: مشاهده وضعیت یک موقعیت.
- close_margin_sell_position: بستن موقعیت فروش تعهدی.

برای جزئیات بیشتر در مورد هر متد، لطفا به نظرات در فایل nobitex.php مراجعه کنید یا به https://apidocs.nobitex.ir/ برای مشاهده مستندات رسمی API نوبیتکس بروید.