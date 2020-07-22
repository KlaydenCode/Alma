<?php
  session_start();
  $dbServername = "mysql";
  $dbUsername = "root";
  $dbPassword = "myrootpwd";
  $dbName = "product";

  $conn = mysqli_connect($dbServername, "root", $dbPassword, $dbName);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Checkout</title>
  <link rel="stylesheet" type="text/css" href="../css/checout.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
  <div class="header">
    <a href="../index.php" id="link" style="color:white; font-size:40px">Get Alma</a>
      <div id="cart_button">
        <a href="./cart.php">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
          <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
          <path fill-rule="evenodd" d="M10.854 7.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 10.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          </svg>
      </div>
    </a>
  </div>
  <div class="form_title">
    <br>
    To proceed the payment please fill this form.
  </div>
  <br>

  <div class="formulaire">
    <form name="form" action="" method="post">
      <div class="form-row">
        <div class="col">
          <label for="last_name">Last name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name">
        </div>
        <div class="col">
          <label for="first_name">First name</label>
          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter first name">
        </div>
      </div>
      <br>
      <div class="form-row">
        <div class="col">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="col">
          <label for="phone">Phone</label>
          <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone">
        </div>
      </div>
      <br>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" class="form-control" id="phone" placeholder="Enter address">
      </div>
      <div class="form-row">
        <div class="col">
          <label for="city">City</label>
          <input type="text" name="city" class="form-control" id="city" placeholder="Enter city">
        </div>
        <div class="col">
          <label for="zip">Zip</label>
          <input type="text" name="zip" class="form-control" id="zip" placeholder="Enter zip code">
        </div>

        <button type="submit" name="proceed_payment" id="mybtn" class="btn btn-primary btn-lg" value="payment()">
          Pay
        </button>
    </form>
    </div>

    <div class="proceed_payment">
    <form method="post">

    </form>
  </div>
  <div class="p_cart">
    <div class="minicart">
      <table style="width:150%">
        <tr>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
        <?php
          $query= "SELECT * FROM product.cart";
          if ($result = $conn->query($query))
          {
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row["name"];
              echo "<td>" . $row["quantity"];
              echo "<td>" . get_price($row['name']);
              echo "</tr>";
            }
          }
        ?>
      </table>
    </div>
    <br>
    <?php  echo "Total :   " .  get_price(null); ?>
  </div>

  <?php

    include "./API.php";

    function print_cart(){
      global $conn;
      $query = "SELECT * FROM product.cart;";
      // echo "Product" . str_repeat('&nbsp', 15) . "Quantity" . str_repeat('&nbsp', 10) . "Price";
      // echo "<br>";


      // if ($result = $conn->query($query)){
      //   while ($row = $result->fetch_assoc()){
      //     echo $row['name'] . str_repeat('&nbsp', 10) . $row['quantity'] . str_repeat('&nbsp', 10) . get_price($row['name']);
      //     echo "<br>";
      //   }
      // }
    }

    function get_price($name){
      global $conn;
      $query_all = "SELECT * FROM product.cart;";
      $query_name = "SELECT * FROM product.cart WHERE name='".$name."';";
      if ($name == null){
        if ($result = $conn->query($query_all)){
          while ($row = $result->fetch_assoc()){
            $price = $price + $row['price'] * $row['quantity'];
          }
        }
      }
      else {
        if ($result = $conn->query($query_name)){
          while ($row = $result->fetch_assoc()){
            $price = $price + $row['price'] * $row['quantity'];
          }
        }
      }
      return ($price);
    }

    function get_json($price)
    {
      $jform = array(
        'payment' => array(
          'purchase_amount' => $price * 100,
          'installments_count' => 3,
          'return_url' => '192.168.99.100/php/confirm-order.php',
          'shipping_address' => array(
            'line1' => $_POST['address'],
            'city' => $_POST['city'],
            'postal_code' => "xn#" . $_POST['zip'],
          )
        ),
        'customer' => array(
          'last_name' => $_POST['last_name'],
          'first_name' => $_POST['first_name'],
          'email' => $_POST['email'],
          'phone' => "xn#" . $_POST['phone']
        )
      );
      $json = json_encode($jform, JSON_NUMERIC_CHECK);
      $json = str_replace('xn#', '', $json);
      // echo ($json);
      return ($json);
    }

    function GoToNow ($url){
      echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
    }

    // $json2 = file_get_contents("../test2.json");
    if (isset($_POST["proceed_payment"])){
      $json = get_json(get_price(null));

      $jdecode = callAPI('POST', $json, "192.168.99.100:5000/payments");
      $_SESSION['jdecode'] = $jdecode;
      echo $jdecode;
      if (strpos($jdecode, "started") !== false){
        $redirect_url = "http://192.168.99.100:8000/php/confirm_order.php";
        GoToNow($redirect_url);
      }
      else if (strpos($jdecode, "installments_count") !== false){
        echo '<div class="alert">Price need to be beetween 150€ & 1000€</div>';
      }
      else
        echo '<div class="alert">Please fill every fields of this form</div>';
    }
  ?>

</body>
