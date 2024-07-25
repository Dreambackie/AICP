<?php
$conn = new mysqli('localhost', 'root', '', 'business_directory');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$business_name = $_POST['business_name'];
$business_description = $_POST['business_description'];
$business_category = $_POST['business_category'];
$business_city = $_POST['business_city'];
$business_address = $_POST['business_address'];
$business_phone = $_POST['business_phone'];
$business_website = $_POST['business_website'];

$stmt = $conn->prepare("
    INSERT INTO businesses (name, description, category_id, city_id, address, phone, website) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    'ssiisss',
    $business_name,
    $business_description,
    $business_category,
    $business_city,
    $business_address,
    $business_phone,
    $business_website
);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: add_business.php');
?>
