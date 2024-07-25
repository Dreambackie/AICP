<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Business Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add Business Profile</h1>
    </header>
    
    <main>
        <section>
            <h2>Add a New Business Profile</h2>
            <form action="insert_business.php" method="post">
                <label for="business_name">Business Name:</label>
                <input type="text" id="business_name" name="business_name" required>
                
                <label for="business_description">Description:</label>
                <textarea id="business_description" name="business_description" required></textarea>
                
                <label for="business_category">Category:</label>
                <select id="business_category" name="business_category" required>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'business_directory');
                    $result = $conn->query("SELECT id, name FROM categories");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>

                <label for="business_city">City:</label>
                <select id="business_city" name="business_city" required>
                    <?php
                    $result = $conn->query("SELECT id, name FROM cities");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>

                <label for="business_address">Address:</label>
                <input type="text" id="business_address" name="business_address" required>
                
                <label for="business_phone">Phone:</label>
                <input type="text" id="business_phone" name="business_phone" required>
                
                <label for="business_website">Website:</label>
                <input type="text" id="business_website" name="business_website">
                
                <input type="submit" value="Add Business">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 BizConnect</p>
    </footer>
</body>
</html>
