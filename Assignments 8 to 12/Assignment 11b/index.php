<?php
// include_once("../../php/hw11/db_secrets") ; 
$servername = "localhost"; $username = "hw11"; $password = "thedrzpassword"; $dbname = "hw11";

// Create a connection
try {
  $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
  die("Connection failed: " . $e);
}

function open_page($title) {echo <<<EOS
  <!DOCTYPE html>
  <html>
    <head>
      <link rel="icon" href="data:,">
        <title>Dr.Z -- $title page</title>
    </head>
    <body>
EOS ; 
}
function close_page() {echo '</body></html>';}

function generateHomePage() {
  global $conn ; 
   ?>
  <form method="get">
    <input type="hidden" name="mode" value="customer"/>
    <label for="customer">Choose a customer:</label>
    <select name="customer">
      <option value="">--Select a Customer--</option>
      <?php
        $sql = "SELECT * from customers order by customerName" ; 
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          echo "<option value=\"{$row['customerNumber']}\">{$row['customerName']}</option>" ; 
        }
      ?>
    </select>
    <input type="submit" name="submit" value="go"/>
  </form>
<?php
}

function generateCustomerPage() {
  global $conn ; 
  $customerID = $_POST['customer'] ?? $_GET['customer'] ?? "" ; 
  if (!$customerID) return generateHomePage() ; 
  $sql = sprintf("select * from `customers` where `customerNumber`='%s'", $conn->real_escape_string($customerID)) ; 
  $result = $conn->query($sql);
  if (!$result->num_rows) {
    return generateHomePage() ; 
  }

  echo '<img src="businesslogo.jpg" width="150" height="150"/>';

  // CUSTOMER INFORMATION
  $customer = $result->fetch_assoc() ; // fetches customer information from database
  echo '<p id="CustomerName">Customer ' . $customer["customerNumber"] . ': ' . $customer["customerName"] . '</p>';
  echo '<p id="CustomerAddress">Address: ' . $customer["addressLine1"] . '<br/>';
  if(isset($customer["addressLine2"])){
    echo 'Address 2: ' . $customer["addressLine2"] . '<br/>';
  } 
  echo $customer["city"];
  if(isset($customer["state"])){
    echo ', ' . $customer["state"];
  }
  echo ', ' . $customer["country"] . ', ' . $customer["postalCode"] . '</p>';
  echo '<p id="RepName">Contact ' . $customer["salesRepEmployeeNumber"] . ': ' . $customer["contactFirstName"] . ' ' . $customer["contactLastName"] . '<br/>Phone Number: ' . $customer["phone"] . '</p>';
  echo '<p id="Credit">Credit Limit: ' . $customer["creditLimit"] . '</p>';

  // ORDER INFORMATION
  $sql = sprintf("select * from `orders` where `customerNumber`='%s'", $conn->real_escape_string($customerID)) ; 
  $result = $conn->query($sql); // queries for order information on specific customer
  $orders = $result->fetch_all() ; // fetches order information on specific customer
  ?>
  <p id="orderSelect">Orders</p>
  <form>
    <input type="hidden" name="mode2" value="orders"/>
    <label for="orders">Choose an order:</label>
    <select name="orders">
      <option value="">--Select an Order--</option>
      <?php
        for($i = 0; $i < sizeof($orders); $i++){
          echo "<option value=\"{$orders[$i][0]}\">{$orders[$i][0]}</option>"; 
        }
      ?>
    </select>
    <input type="button" name="ordersubmit" value="go"/>
  </form>
  <?php

  // PAYMENT INFORMATION
  $sql = sprintf("select * from `payments` where `customerNumber`='%s'", $conn->real_escape_string($customerID)) ; 
  $result = $conn->query($sql); // queries for payment information on specific customer
  $payments = $result->fetch_all(); // fetches payment information on specific customer
  echo '<p id="paymentHeader">Payments</p><table id="PaymentsTable">';
  echo '<tr> <th>Product Code</th> <th>Date</th> <th>Paid</th> </tr>';
  for($i = 0; $i < sizeof($payments); $i++){
    echo '<tr>';
    echo '<td>' . $payments[$i][1] . '</td>';
    echo '<td>' . $payments[$i][2] . '</td>';
    echo '<td>' . $payments[$i][3] . '</td>';
    echo '</tr>';
  }
  echo '</table>';
  ?>
  <style>
  table, th, td {
    border:1px solid black;
  }
  #paymentHeader, #CustomerName, #orderSelect {
    font-size: 16pt;
    font-weight: bold;
    text-decoration: overline underline;
  }
  #CustomerAddress, #RepName, #Credit {
    font-style: italic;
  }
  </style>
  <?php
}


$router = [
  "home" => 'generateHomePage' ,
  "customer" => 'generateCustomerPage', 
] ; 

$MODE = $_POST['mode'] ?? $_GET['mode'] ?? 'home' ;
if (!array_key_exists($MODE,$router)) $MODE = "home" ; 

open_page($MODE) ; 
$router[$MODE]() ; 
close_page() ; 
?>
