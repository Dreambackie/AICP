<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Businesses in Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Businesses in Category</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="admin_home.php">Admin</a>
        </nav>
    </header>

    <main>
        <section>
            <?php
            $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

            $conn = new mysqli('localhost', 'root', '', 'business_directory');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("
                SELECT c.name AS category_name, b.name, b.description, b.address, b.phone, b.website
                FROM businesses b
                JOIN categories c ON b.category_id = c.id
                WHERE c.id = ?
            ");
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                echo "SQL Error: " . $stmt->error;
            } else {
                $category_name = '';
                if ($row = $result->fetch_assoc()) {
                    $category_name = $row['category_name'];
                    echo "<h2>Businesses in {$category_name}</h2>";
                    echo "<ul>";
                    do {
                        echo "<li>";
                        echo "<h3>{$row['name']}</h3>";
                        echo "<p>{$row['description']}</p>";
                        echo "<p>Address: {$row['address']}</p>";
                        echo "<p>Phone: {$row['phone']}</p>";
                        echo "<p>Website: <a href='{$row['website']}'>{$row['website']}</a></p>";
                        echo "</li>";
                    } while ($row = $result->fetch_assoc());
                    echo "</ul>";
                } else {
                    echo "<p>No businesses found in this category.</p>";
                }
            }

            $stmt->close();
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
    <p>&copy; 2024 BizConnect</p>
    </footer>
</body>
</html>
