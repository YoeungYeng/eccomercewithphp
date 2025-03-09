<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// Validate JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON", "details" => json_last_error_msg()]);
    exit;
}

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(["error" => "Cart is empty"]);
    exit;
}

// 🏦 ABA Payway Credentials (Replace with your actual credentials)
$ABA_PAYWAY_API_URL = "https://link.payway.com.kh/aba?id=F4FCE07F4B8C&code=699768&acc=003995754&dynamic=true";
$ABA_PAYWAY_API_KEY = "096b56dee15c4ce58e56658f568a7b73551b3c77";
$ABA_PAYWAY_MERCHANT_ID = "ec449300";

$req_time = time();
$transactionId = "ORD" . $req_time . rand(1000, 9999);
$amount = 0;
$itemsArray = [];

// Calculate total amount & format items list
foreach ($data['cart'] as $item) {
    $amount += floatval($item['price']) * intval($item['quantity']);
    $itemsArray[] = [
        "name" => htmlspecialchars($item["name"]),
        "quantity" => (string) $item["quantity"],
        "price" => number_format($item["price"], 2, '.', '')
    ];
}

// Encode items as Base64 JSON
$items = base64_encode(json_encode($itemsArray));
$shipping = "1.00";
$firstName = "John";
$lastName = "Doe";
$phone = "0123456789";
$email = "customer@example.com";
$return_params = "Order Completed";
$type = "purchase";
$currency = "USD";

// 🔐 Generate Secure Hash (HMAC-SHA512)
$hash_string = $req_time . $ABA_PAYWAY_MERCHANT_ID . $transactionId . $amount . $items .
    $shipping . $firstName . $lastName . $email . $phone . $type . $currency . $return_params;
$hash = base64_encode(hash_hmac("sha512", $hash_string, $ABA_PAYWAY_API_KEY, true));

// 🔗 Generate Redirect URL to ABA Payway
$redirect_url = "$ABA_PAYWAY_API_URL?" .
    "hash=" . urlencode($hash) .
    "&tran_id=" . urlencode($transactionId) .
    "&amount=" . urlencode($amount) .
    "&firstname=" . urlencode($firstName) .
    "&lastname=" . urlencode($lastName) .
    "&phone=" . urlencode($phone) .
    "&email=" . urlencode($email) .
    "&items=" . urlencode($items) .
    "&return_params=" . urlencode($return_params) .
    "&shipping=" . urlencode($shipping) .
    "&currency=" . urlencode($currency) .
    "&type=" . urlencode($type) .
    "&merchant_id=" . urlencode($ABA_PAYWAY_MERCHANT_ID) .
    "&req_time=" . urlencode($req_time);

// 🛒 Return JSON response with redirect URL
echo json_encode(["redirect_url" => $redirect_url]);
exit;
?>