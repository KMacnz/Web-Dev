<?php
session_start();

//$newitem = $_GET["book"]; // Get the book value from the GET request
$action = $_GET["action"]; // Get the action value from the GET request
$isbn = $_GET["isbn"]; // Get the ISBN value from the GET request

if (array_key_exists("Cart", $_SESSION)) {
    // Check if "Cart" key exists in the session
    $cart = $_SESSION["Cart"]; // Retrieve the cart array from the session

    if ($action == "Add") {
        // If the action is "Add"
        if (isset($cart[$isbn])) {
            // If the item already exists in the cart
            $value = $cart[$isbn] + 1; // Increment the value of the item
            $cart[$isbn] = $value;
        } else {
            // If the item doesn't exist in the cart
            $cart[$isbn] = 1; // Set the value of the item to 1
        }
    } else {
        // If the action is not "Add" (assumed to be "Remove")
        if (isset($cart[$isbn])) {
            // If the item exists in the cart
            $value = $cart[$isbn] - 1; // Decrement the value of the item
            if ($value <= 0) {
                unset($cart[$isbn]); // Remove the item from the cart if its value becomes zero or negative
            } else {
                $cart[$isbn] = $value; // Update the item's value in the cart
            }
        }
    }
} else {
    // If the "Cart" key doesn't exist in the session
    $cart = [$isbn => 1]; // Add the item to the cart with a value of 1
}

$_SESSION["Cart"] = $cart; // Update the cart array in the session

if (empty($cart)) {
    // If the cart is empty
    unset($_SESSION["Cart"]); // Remove the "Cart" key from the session
} else {
    // If the cart is not empty
    echo json_encode($cart, JSON_PRETTY_PRINT); // Return the cart array as JSON
}
?>
