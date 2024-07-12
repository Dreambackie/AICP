<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registeration";  // Ensure your database name is correct
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // SQL query to select data from table
    $sql = "SELECT `Name`, `DOB`, `Email`, `Phone`, `Gender`, `Occupation`, `ID Type`, `ID number`, `Issue Authority`, `Issue Date`, `Issue State`, `Expiry Date` FROM `registeration data`";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>DOB</th><th>Email</th><th>Phone</th><th>Gender</th><th>Occupation</th><th>ID Type</th><th>ID Number</th><th>Issue Authority</th><th>Issue Date</th><th>Issue State</th><th>Expiry Date</th></tr>";
        
        // Fetch data and display in table rows
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Name"] . "</td>
                    <td>" . $row["DOB"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Phone"] . "</td>
                    <td>" . $row["Gender"] . "</td>
                    <td>" . $row["Occupation"] . "</td>
                    <td>" . $row["ID Type"] . "</td>
                    <td>" . $row["ID number"] . "</td>
                    <td>" . $row["Issue Authority"] . "</td>
                    <td>" . $row["Issue Date"] . "</td>
                    <td>" . $row["Issue State"] . "</td>
                    <td>" . $row["Expiry Date"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    
    $conn->close();
    
    ?>
</body>
</html>