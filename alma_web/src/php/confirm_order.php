<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/confirm_order.css">
  <link rel="stylesheet" href="https://fonts.google.com/specimen/Montserrat+Subrayada?sidebar.open&selection.family=Montserrat+Subrayada:wght@700#standard-styles" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>Confirm order</title>
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
  <div class="check">
    <svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
    </svg>
  <div class="check-text">Checkout complete</div>

<?php

  $jdecode = $_SESSION['jdecode'];
  $j = json_decode($jdecode, true);
  // echo $jdecode;
  echo "<div class='installments_count'>";
  echo 'Payments by '. str_repeat("&nbsp", 3) . $j["installments_count"] . str_repeat("&nbsp", 3) . " times<br><br>";
  for ($i = 0; $i < $j["installments_count"]; $i++){
        if ($i == 0)
          $total = (($j["installments"][$i]["net_amount"]/100) + ($j["installments"][0]["customer_fee"]/100));
        else
          $total = ($j["installments"][$i]["net_amount"]/100);
      echo '<br>' . ($i + 1) . str_repeat("&nbsp", 3) . ' Payment :' . str_repeat("&nbsp", 5) . $total . " €<br>";
  }
  echo '</div>';
?>
</body>
