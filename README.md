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

