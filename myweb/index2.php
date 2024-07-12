
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registeration"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $idType = $_POST['idType'];
    $idNumber = $_POST['idNumber'];
    $issueAuthority = $_POST['issueAuthority'];
    $issueDate = $_POST['issueDate'];
    $issueState = $_POST['issueState'];
    $expiryDate = $_POST['expiryDate'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO `registeration data` (`Name`, `DOB`, `Email`, `Phone`, `Gender`, `Occupation`, `ID Type`, `ID number`, `Issue Authority`, `Issue Date`, `Issue State`, `Expiry Date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssss", $fullName, $dob, $email, $mobileNumber, $gender, $occupation, $idType, $idNumber, $issueAuthority, $issueDate, $issueState, $expiryDate);

    if ($stmt->execute()) {
        echo '<p style = "font-size: 25px; text-align: center;  color: blue;"><b>New record created successfully!</b></p>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<div style="margin: auto; text-align: center">
    <a href="index3.php", style = 'text-decoration: none'>
    <botton style = 'padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 2px;
    cursor: pointer;
    width: 200px;
    align: center;
    box-shadow: 0 5px 5px #000000a6;', method = "GET">Show record</botton>
    </a>
    
</body></div>

</html>