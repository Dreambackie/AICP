<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Delete.css">
    <title>Delete Task</title>
</head>
<body>
    <div class="content-wrapper">
        <h1>Delete Task</h1>
        <div class="container">
            <form id="deleteForm" method="POST">
                <div class="mb-3">
                    <label for="taskId" class="form-label">Task ID</label>
                    <input type="text" class="form-control" id="taskId" name="taskId" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete Task</button>
            </form>
        </div>
    </div>

    <!-- Task Details Modal -->
    <div id="taskDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('taskDetailsModal')">&times;</span>
                <h2>Task Details</h2>
            </div>
            <div class="modal-body">
                <p><strong>Task ID:</strong> <span id="taskDetailsId"></span></p>
                <p><strong>Task Name:</strong> <span id="taskDetailsName"></span></p>
                <p><strong>Description:</strong> <span id="taskDetailsDescription"></span></p>
                <p><strong>Priority:</strong> <span id="taskDetailsPriority"></span></p>
                <p><strong>Time:</strong> <span id="taskDetailsTime"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="confirmDelete()">Confirm Delete</button>
                <button class="btn btn-secondary" onclick="closeModal('taskDetailsModal')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Success Message Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('successModal')">&times;</span>
                <h2>Success</h2>
            </div>
            <div class="modal-body">
                <p>Task deleted successfully.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="redirectToHome()">OK</button>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId']) && !isset($_POST['confirmDelete'])) {
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

        // Get POST data
        $taskId = $conn->real_escape_string($_POST['taskId']);

        // Retrieve task details
        $sql_select = "SELECT * FROM tasks WHERE `no` = '$taskId'";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $taskName = $row['Name'];
            $description = $row['Description'];
            $priority = $row['Priority'];
            $time = $row['Time'];

            echo "<script>
                document.getElementById('taskDetailsId').innerText = '$taskId';
                document.getElementById('taskDetailsName').innerText = '$taskName';
                document.getElementById('taskDetailsDescription').innerText = '$description';
                document.getElementById('taskDetailsPriority').innerText = '$priority';
                document.getElementById('taskDetailsTime').innerText = '$time';
                document.getElementById('taskDetailsModal').style.display = 'block';
            </script>";
        } else {
            echo "<script>alert('No task found with ID: $taskId');</script>";
        }

        $conn->close();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDelete'])) {
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

        // Get POST data
        $taskId = $conn->real_escape_string($_POST['taskId']);

        // Delete task from database
        $sql_delete = "DELETE FROM tasks WHERE `no` = '$taskId'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<script>
                document.getElementById('taskDetailsModal').style.display = 'none';
                document.getElementById('successModal').style.display = 'block';
            </script>";
        } else {
            echo "<script>alert('Error deleting task: " . $conn->error . "');</script>";
        }

        $conn->close();
    }
    ?>

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function confirmDelete() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';

            const taskIdInput = document.createElement('input');
            taskIdInput.type = 'hidden';
            taskIdInput.name = 'taskId';
            taskIdInput.value = document.getElementById('taskDetailsId').innerText;
            form.appendChild(taskIdInput);

            const confirmDeleteInput = document.createElement('input');
            confirmDeleteInput.type = 'hidden';
            confirmDeleteInput.name = 'confirmDelete';
            confirmDeleteInput.value = 'true';
            form.appendChild(confirmDeleteInput);

            document.body.appendChild(form);
            form.submit();
        }

        function redirectToHome() {
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
