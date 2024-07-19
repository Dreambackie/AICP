<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="list.css">
    <title>List Tasks</title>
</head>
<body>
    <div class="content-wrapper">
        <h1>Task List</h1>
        <div class="container">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "to-do list";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve tasks from database
            $sql = "SELECT * FROM tasks";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='task-block'>";
                    echo "<p><strong>Task ID:</strong> " . $row['no'] . "</p>";
                    echo "<p><strong>Task Name:</strong> " . $row['Name'] . "</p>";
                    echo "<p><strong>Description:</strong> " . $row['Description'] . "</p>";
                    echo "<p><strong>Priority:</strong> " . $row['Priority'] . "</p>";
                    echo "<p><strong>Time:</strong> " . $row['Time'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No tasks found</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
