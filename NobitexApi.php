<?php
class Nobitex {
  // A variable to store the authentication token
  private $token;
  private $base='https://api.nobitex.ir/';
  // A constructor to get the token when creating an instance of the class

  /**
   * Yoy also can login with username and password. So leave token empty now and then call login function.
   */
  public function __construct($token=null) {
    $this->token = $token;
  }
  // A function to create web requests with different methods
  public function web_request($function, $method, $data = null) {
    // Initialize a curl session
    $curl = curl_init();
    // Set the url and the method
    curl_setopt($curl, CURLOPT_URL, $this->base.$function);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    // If the method is post or put, set the data
    if ($method == "POST" || $method == "PUT") {
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    // Set some options for the request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Set the authorization header with the token
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Authorization: Token ' . $this->token,
      'UserAgent : TraderBot/XXXXX '
    ));
    // Execute the request and get the response
    $response = curl_exec($curl);
    // Close the curl session
    curl_close($curl);
    // Return the response
    return $response;
  }

  // A function to login and get the token
  public function login($username, $password) {
    // Set the url for the login request
    $url = "https://api.nobitex.ir/auth/login/";
    // Set the method for the login request
    $method = "POST";
    // Set the data for the login request
    $data = array(
        "username" => $username,
        "password" => $password
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request($url, $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a token key
    if (isset($response["token"])) {
      // Set the token as the class variable
      $this->token = $response["token"];
      // Return true to indicate success
      return true;
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function orderbook($order = "price", $type = null, $srcCurrency = null, $dstCurrency = null) {
    // Set the method for the orderbook request
    $method = "POST";
    // Set the data for the orderbook request
    $data = array(
        "order" => $order
    );
    // If type is not null, add it to the data
    if ($type != null) {
      $data["type"] = $type;
    }
    // If srcCurrency is not null, add it to the data
    if ($srcCurrency != null) {
      $data["srcCurrency"] = $srcCurrency;
    }
    // If dstCurrency is not null, add it to the data
    if ($dstCurrency != null) {
      $data["dstCurrency"] = $dstCurrency;
    }
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/orders/list", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the orders array from the response
      return $response["orders"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function trades_list($srcCurrency, $dstCurrency) {
    // Set the method for the trades list request
    $method = "POST";
    // Set the data for the trades list request
    $data = array(
        "srcCurrency" => $srcCurrency,
        "dstCurrency" => $dstCurrency
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/trades/list", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the trades array from the response
      return $response["trades"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function nobitex_public_market_data() {
    // Set the method for the nobitex public market data request
    $method = "POST";
    // Set the data for the nobitex public market data request
    $data = array();
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/stats", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the stats array from the response
      return $response["stats"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function global_market_statistics() {
    // Set the method for the global market statistics request
    $method = "POST";
    // Set the data for the global market statistics request
    $data = array();
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/global-stats", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the response array
      return $response;
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function orderbook_v2($symbol) {
    // Set the method for the orderbook request
    $method = "GET";
    // Call the web_request function with the url and method
    $response = $this->web_request("v2/orderbook/" . $symbol, $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the response array
      return $response;
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function register_new_order($type, $srcCurrency, $dstCurrency, $amount, $price, $clientOrderId) {
    // Set the method for the register new order request
    $method = "POST";
    // Set the data for the register new order request
    $data = array(
        "type" => $type,
        "srcCurrency" => $srcCurrency,
        "dstCurrency" => $dstCurrency,
        "amount" => $amount,
        "price" => $price,
        "clientOrderId" => $clientOrderId
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/orders/add", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the order array from the response
      return $response["order"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function order_status($id) {
    // Set the method for the order status request
    $method = "POST";
    // Set the data for the order status request
    $data = array(
        "id" => $id
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/orders/status", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the order array from the response
      return $response["order"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function user_orders($srcCurrency, $dstCurrency, $details = null) {
    // Set the method for the user orders request
    $method = "GET";
    // Set the url for the user orders request
    // If details is not null, add it to the url
    if ($details != null) {
      $url .= "&details=" . $details;
    }
    // Call the web_request function with the url and method
    $response = $this->web_request("market/orders/list?srcCurrency=" . $srcCurrency . "&dstCurrency=" . $dstCurrency, $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the orders array from the response
      return $response["orders"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function change_order_status($order, $status) {
    // Set the method for the change order status request
    $method = "POST";
    // Set the data for the change order status request
    $data = array(
        "order" => $order,
        "status" => $status
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("market/orders/update-status", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the updatedStatus from the response
      return $response["updatedStatus"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function user_trades_list($srcCurrency, $dstCurrency) {
    // Set the method for the user trades list request
    $method = "GET";
    // Set the url for the user trades list request
        // Call the web_request function with the url and method
    $response = $this->web_request("market/trades/list?srcCurrency=" . $srcCurrency . "&dstCurrency=" . $dstCurrency, $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the trades array from the response
      return $response["trades"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function user_profile() {
    // Set the method for the user profile request
    $method = "GET";
    // Set the url for the user profile request
    // Call the web_request function with the url and method
    $response = $this->web_request('users/profile', $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the profile array from the response
      return $response["profile"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function user_wallets_list() {
    // Set the method for the user wallets list request
    $method = "GET";
    // Set the url for the user wallets list request
    // Call the web_request function with the url and method
    $response = $this->web_request('users/wallets/list', $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the wallets array from the response
      return $response["wallets"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function wallet_balance($currency) {
    // Set the method for the wallet balance request
    $method = "POST";
    // Set the data for the wallet balance request
    $data = array(
        "currency" => $currency
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("users/wallets/balance", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the balance from the response
      return $response["balance"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function transactions_list($wallet) {
    // Set the method for the transactions list request
    $method = "GET";
    // Set the url for the transactions list request
    // Call the web_request function with the url and method
    $response = $this->web_request("/users/wallets/transactions/list?wallet=" . $wallet, $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the transactions array from the response
      return $response["transactions"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function register_withdrawal($wallet, $invoice, $totp) {
    // Set the method for the withdrawal request
    $method = "POST";
    // Set the data for the withdrawal request
    $data = array(
        "wallet" => $wallet,
        "invoice" => $invoice
    );
    // Encode the data as json
    $data = json_encode($data);
    // Set the headers for the withdrawal request
    $headers = array(
        "Authorization: Token " . $this->token,
        "X-TOTP: " . $totp,
        "Content-Type: application/json"
    );
    // Call the web_request function with the url, method, data and headers
    $response = $this->web_request("users/wallets/withdraw", $method, $data, $headers);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the withdraw array from the response
      return $response["withdraw"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function margin_markets_list() {
    // Set the method for the margin markets list request
    $method = "GET";
    // Set the url for the margin markets list request
    // Call the web_request function with the url and method
    $response = $this->web_request('margin/markets/list', $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the markets array from the response
      return $response["markets"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function add_margin_sell_order($srcCurrency, $dstCurrency, $amount, $price) {
    // Set the method for the margin sell order request
    $method = "POST";
    // Set the data for the margin sell order request
    $data = array(
        "srcCurrency" => $srcCurrency,
        "dstCurrency" => $dstCurrency,
        "amount" => $amount,
        "price" => $price
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("margin/orders/add", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the order array from the response
      return $response["order"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function positions_list($srcCurrency, $status) {
    // Set the method for the positions list request
    $method = "GET";
    // Set the url for the positions list request

    // Call the web_request function with the url and method
    $response = $this->web_request("/positions/list?srcCurrency=" . $srcCurrency . "&status=" . $status, $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the positions array from the response
      return $response["positions"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function position_status($positionId) {
    // Set the method for the position status request
    $method = "GET";
    // Set the url for the position status request

    // Call the web_request function with the url and method
    $response = $this->web_request("positions/" . $positionId . "/status", $method);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the position array from the response
      return $response["position"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }

  public function close_margin_sell_position($positionId, $amount, $price) {
    // Set the method for the close margin sell position request
    $method = "POST";
    // Set the data for the close margin sell position request
    $data = array(
        "amount" => $amount,
        "price" => $price
    );
    // Encode the data as json
    $data = json_encode($data);
    // Call the web_request function with the url, method and data
    $response = $this->web_request("positions/" . $positionId . "/close", $method, $data);
    // Decode the response as an associative array
    $response = json_decode($response, true);
    // Check if the response has a status key and it is ok
    if (isset($response["status"]) && $response["status"] == "ok") {
      // Return the order array from the response
      return $response["order"];
    } else {
      // Return false to indicate failure
      return false;
    }
  }
}
?>
