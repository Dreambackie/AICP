<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-home-style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add_city.php">Add City/Town</a></li>
                <li><a href="add_category.php">Add Business Category</a></li>
                <li><a href="add_business.php">Add Business Profile</a></li>
                <li><a href="admin-home.php#about">About Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Categories</h2>
            <ul class="category-list">
                <?php
                $conn = new mysqli('localhost', 'root', '', 'business_directory');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM categories");

                if ($result === false) {
                    echo "SQL Error: " . $conn->error;
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><a href='businesses.php?category_id={$row['id']}'>{$row['name']}</a></li>";
                    }
                }

                $conn->close();
                ?>
            </ul>
        </section>

        <section>
            <h2>Summary</h2>
            <div class="summary">
                <div class="summary-item">
                    <h3>Total Cities</h3>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'business_directory');
                    $result = $conn->query("SELECT COUNT(*) AS total FROM cities");
                    $row = $result->fetch_assoc();
                    echo "<p>{$row['total']}</p>";
                    ?>
                </div>
                <div class="summary-item">
                    <h3>Total Categories</h3>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS total FROM categories");
                    $row = $result->fetch_assoc();
                    echo "<p>{$row['total']}</p>";
                    ?>
                </div>
                <div class="summary-item">
                    <h3>Total Businesses</h3>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS total FROM businesses");
                    $row = $result->fetch_assoc();
                    echo "<p>{$row['total']}</p>";
                    ?>
                </div>
            </div>
        </section>

        <section id="about">
            <h2>About Us</h2>
            <div class="about-columns">
                <div class="about-left">
                    <p>Welcome to Business Directory, your go-to platform for discovering top-rated businesses in various categories. Whether you're looking for the best restaurants, schools, or real estate agents, we have you covered.</p>
                    <p>Our mission is to provide a comprehensive and user-friendly directory to help you find the right businesses quickly and easily.</p>
                </div>
                <div class="about-right">
                    <p>Our platform features:</p>
                    <ul>
                        <li>A wide range of business categories</li>
                        <li>Detailed business profiles</li>
                        <li>Easy-to-navigate interface</li>
                    </ul>
                    <p>Thank you for visiting our site. If you have any questions or feedback, feel free to contact us!</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 BizConnect</p>
    </footer>
</body>
</html>
