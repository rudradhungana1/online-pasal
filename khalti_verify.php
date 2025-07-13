<?php
// Khalti Verify API
$khalti_secret_key = "test_secret_key_1234567890"; // Replace with your Khalti secret key

// Get the payload from the request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['token']) && isset($data['amount'])) {
    $args = http_build_query([
        'token' => $data['token'],
        'amount' => $data['amount']
    ]);

    $url = "https://khalti.com/api/v2/payment/verify/";

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Key $khalti_secret_key"
    ]);

    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
        // Payment is successful
        echo json_encode(["success" => true, "message" => "Payment verified."]);
    } else {
        // Payment verification failed
        echo json_encode(["success" => false, "message" => "Verification failed."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid data received."]);
}
?>
