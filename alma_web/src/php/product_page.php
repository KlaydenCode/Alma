<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Product page</title>
  <link rel="stylesheet" type="text/css" href="../css/product_page.css">
  <link rel="stylesheet" href="https://fonts.google.com/specimen/Montserrat+Subrayada?sidebar.open&selection.family=Montserrat+Subrayada:wght@700#standard-styles" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<script src="../js/vue.js"></script>

<body>
  <div class="slideshow-container">
    <!-- Get images -->
    <?php
      $dir_name = "./img/";
      $imgs = glob($dir_name."KB*.jpg");
      foreach($imgs as $img) {
        echo '<div class="product_img">';
        echo '<img src="'.$img.'" style="width:100%"/>';
        echo '</div>';
      }
    ?>

    <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
    <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>

    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </div>
  <div class="info-container">
    <div class="product_name">
      <?php
        $query = "SELECT * FROM product.products_infos WHERE name='Apple keyboard';";
        if ($result = $conn->query($query))
        {
          while ($row = $result->fetch_assoc()){
            echo $row["name"] . "<br>";
          }
        }
        else{
          echo "No results";
        }
      ?>
    </div>
    <br>
    <div class="product_price">
      <?php
        if ($result = $conn->query($query))
        {
          while ($row = $result->fetch_assoc()){
            echo $row["price"] . "$" . "<br>";
          }
        }
        else{
          echo "No results";
        }
      ?>
    </div>
    <br>
    <div class="product_avaibility">
      <?php
      if ($result = $conn->query($query))
      {
        while ($row = $result->fetch_assoc()){
          echo "Number of product available: " . $row["quantity"] . "<br>";
        }
      }
      else{
        echo "No results";
      }
      ?>
    </div>
      <br>

      <div class="add_to_cart">
        <form method="post">
        <button type="submit" name="add_cart" class="btn btn-primary btn-lg" value="go_to_cart()">
          Add to cart
        </button>
        </form>
      </div>
      <?php
        function console_log( $data ){
          echo '<script>';
          echo 'console.log('. json_encode( $data ) .')';
          echo '</script>';
        }

        function count_item_in_cart($name){
          global $conn;
          $count_item_query = "SELECT * FROM product.cart WHERE name='".$name."';";
          $t = $conn->query($count_item_query);
          while ($row = $t->fetch_assoc())
          {
            $quantity_available = $row['quantity_available'];
            if ($row["name"] == 'Apple keyboard')
            {
              $count = $row['quantity'] + 1;
            }
          }
          if ($count > $quantity_available)
            return ($quantity_available);
          return ($count);
        }

        function modify_item_cart($count, $name){
          global $query;
          global $conn;

          $result = $conn->query($query);
          $row = $result->fetch_assoc();
          if ($count > 0)
          {
            $remove_item_query = "DELETE FROM product.cart WHERE name='".$name."'";
            $conn->query($remove_item_query);
            $cart_add_to_db_query = "INSERT INTO product.cart(name, price, quantity_available, quantity) VALUES('".$row['name']."', '".$row['price']."', '".$row['quantity']."', '".$count."');";
            $conn->query($cart_add_to_db_query);
          }
          else {
            $cart_add_to_db_query = "INSERT INTO product.cart(name, price, quantity_available, quantity) VALUES('".$row['name']."', '".$row['price']."', '".$row['quantity']."', 1);";
            $conn->query($cart_add_to_db_query);
          }
        }

        function go_to_cart()
        {
          console_log("Item added to the cart");
        }
        if (isset($_POST["add_cart"])){
          go_to_cart();
          $result = $conn->query($query);
          if (!$result)
            console_log("No result found");
          $row = $result->fetch_assoc();
          // if (!$row["name"])
          //   console_log("No name found");
          // else {
          //   echo "row[name] -> " . $row["name"]. "<br>";
          // }
          $name = $row["name"];
          // if (!$name)
          //   console_log("No name found");
          // else {
          //   echo "name -> " . $name . "<br>";
          // }
          $c = count_item_in_cart('Apple keyboard');
          modify_item_cart($c, 'Apple keyboard');
        }
      ?>
  </div>
  <br>

  <script>

    // Images slideshow
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("product_img");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
    }

  </script>

</body>
</html>
