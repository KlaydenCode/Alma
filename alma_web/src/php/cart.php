<?php
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
  <title>Cart page</title>
  <link rel="stylesheet" type="text/css" href="../css/cart.css">
  <link rel="stylesheet" href="https://fonts.google.com/specimen/Montserrat+Subrayada?sidebar.open&selection.family=Montserrat+Subrayada:wght@700#standard-styles" />
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
  <h1>CART</h1>
  <div id="mytable">
  <div class="table-responsive">
    <table class="table table-bordered" id="cart_table">
      <thead class="thead-dark">
        <tr>
          <th class="col-lg-5" scope="img">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-image-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.648 6.646a.5.5 0 0 1 .577-.093l4.777 3.947V15a1 1 0 0 1-1 1h-14a1 1 0 0 1-1-1v-2l3.646-4.354a.5.5 0 0 1 .63-.062l2.66 2.773 3.71-4.71z"/>
                      <path fill-rule="evenodd" d="M4.5 5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                  </th>
          <th class="col-lg-3" scope="Name">Name</th>
          <th class="col-lg-2" scope="Price">Price</th>
          <th class="col-lg-2" scope="Quantity">Quantity</th>
          <!-- <span class="a-button-text a-declarative" data-action="a-dropdown-button" role="button" aria-hidden="true" id="quantity_btn"></span> -->
        </tr>
      </thead>

      <tbody>
        <?php
          $query= "SELECT * FROM product.cart";
          if ($result = $conn->query($query))
          {
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row["id"];
              echo "<td>" . $row["name"];
              echo "<td>" . $row["price"];
              echo "<td>" . $row["quantity"];
              echo "</tr>";
            }
          }
        ?>

      </tbody>
    </table>
  </div>
  </div>
  <a href= "./checkout.php">
    <button type="submit" name="checkout" class="btn btn-primary btn-lg" value="checkout()">
      Checkout
    </button>
  </a>
</body>
