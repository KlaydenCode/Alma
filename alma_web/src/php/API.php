<!-- <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>API TEST</title>
  <link rel="stylesheet" type="text/css" href="../css/.css">
</head>
<body>
  <h1> TEST API </h1> -->
<?php
  function callAPI($method, $data, $url){
      $curl = curl_init();
      switch ($method) {
        case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data){
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          }
          break;
        case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "GET":
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        default:
          if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    if(!$result){
      die("Connection Failure");
    }
    curl_close($curl);
    // echo $result;
    return $result;
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    }



  // $json = file_get_contents("../test.json");
  // $json2 = file_get_contents("../test2.json");
  // $get_data = callAPI('POST', $json, "192.168.99.100:5000/payments/eligibility");
  // echo "<br><br><br><br>";
  // $get_data = callAPI('POST', $json2, "192.168.99.100:5000/payments");
  // echo "<br><br><br><br>";
  // $get_data = callAPI('GET', false, "192.168.99.100:5000/payments/885415eb71454ef3b723428b65afebbf");
?>


<!-- </body> -->
