<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Add.css">
    <title>Add Task</title>
</head>
<body>
    <div class="content-wrapper">
        <h1>Add Task</h1>
        <div class="container">
            <form id="taskForm" method="POST">
                <div class="mb-3">
                    <label for="taskName" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="taskName" name="taskName" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="datetime-local" class="form-control" id="time" name="time" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>
    <dialog id="successDialog">
        <div class="dialog-content">
        <p>Task Added Successfully</p>
        <button class="btn btn-primary" onclick="redirectToHome()">OK</button>
        </div>
        </dialog>
    <script>
        function showDialog() {
            const dialog = document.getElementById('successDialog');
            dialog.showModal();
        }

        function redirectToHome() {
            window.location.href = 'index.php';
        }
    </script>

</body>
</html>


<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "to-do list"; // Ensure the database name does not contain spaces

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $taskName = $conn->real_escape_string($_POST['taskName']);
    $description = $conn->real_escape_string($_POST['description']);
    $priority = $conn->real_escape_string($_POST['priority']);
    $time = $conn->real_escape_string($_POST['time']);

    // Insert data into the database
    $sql = "INSERT INTO tasks (Name, Description, Priority, Time) VALUES ('$taskName', '$description', '$priority', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>showDialog();</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>