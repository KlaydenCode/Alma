<?php
  $dbServername = "mysql";
  $dbUsername = "root";
  $dbPassword = "myrootpwd";
  $dbName = "product";

  // $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
  $link = mysqli_connect("192.168.99.100:8082", $dbUsername, $dbPassword);
  $sql_query = "CREATE DATABASE product;";
  $link->query($sql_query);
  $conn = mysqli_connect($dbServername, "root", $dbPassword, $dbName);
  if (!$conn){
    echo "Unable to connect to mySQL" . PHP_EOL;
    echo "Errno " . mysqli_connect_errno() . PHP_EOL;
    echo "Error " . mysqli_connect_error() . PHP_EOL;
    exit ;
  }
    $product_DB_query = "CREATE TABLE products_infos(id INT AUTO_INCREMENT PRIMARY KEY not null, name VARCHAR(20), price INT, quantity INT);";
    $conn->query($product_DB_query);
    // $check_DB_query = "SELECT * FROM product.products_infos;";
    // $check_DB_query = "DESCRIBE product.product_infos";

    // if (table_exists($conn, "products_infos") == TRUE)
    // {
    //   echo "exist";
    // }
    // else {
    //   $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
    //   $conn->query($products_infos_query);
    //   echo "doesnt exist";
    // }
    $lks = "SELECT * FROM product.products_infos;";
    if ($rqq = $conn->query($lks)){
      if (!$row = $rqq->fetch_assoc())
      {
        $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
        $conn->query($products_infos_query);
      }
    }

    //   while ($row = $rqq->fetch_assoc())
    //   {
    //     echo "<div>" . $row['name'] . "</div>";
    //     if (strcmp($row['name'], 'Apple keyboard') == 0){
    //       echo "<br><div>no diff so dont add</div>";
    //     }
    //     else {
    //         $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
    //         $conn->query($products_infos_query);
    //         echo "diff add";
    //     }
    //   }
    // }
    // else {
    //   echo "<div>no fcking clue</div>";
    // }


    // $exist = $conn->query("SELECT 1 FROM product.product_infos;");
    // if ($exist !== FALSE){
    //   echo "it exist";
      // $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
      // $conn->query($products_infos_query);
    // }
    // else {
    //   echo "doesnt exist";
    //   $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
    //   $conn->query($products_infos_query);
    //   echo "<br>info added";
    // }
    // $products_infos_query = "INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);";
    // $conn->query($products_infos_query);
    // $dir_name = "../../img/";
    // $img_DB_query = "CREATE TABLE img(id INT AUTO_INCREMENT PRIMARY KEY not null, image blob, PRIMARY KEY('image_id'));";


    $cart_DB_query = "CREATE TABLE cart(id INT AUTO_INCREMENT PRIMARY KEY not null, name VARCHAR(20), price INT, quantity_available INT, quantity INT);";
    $conn->query($cart_DB_query);
    // if ($conn->query($cart_DB_query))
    // {
    //   echo "Table cart created";
    // }
    // else {
    //   echo "Error creating table" . $conn->error;
    // }

    // $add_cart_info = "INSERT INTO cart(name, price, quantity_available, quantity) VALUES ('Apple keyboard', 99, 10, 1);";
    // if ($conn->query($add_cart_info))
    // {
    //   echo "Data to cart";
    // }
    // else {
    //   echo "Error data to cart" . $conn->error;
    // }

  // echo "Connection success" . PHP_EOL;
  // echo "Host information" . mysqli_get_host_info($conn) . PHP_EOL;
  // mysqli_close($conn);
 ?>
