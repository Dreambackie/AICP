<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizConnect</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>BizConnect</h1>
        <nav>
            <ul>
                <a href="login.php">Admin Login</a>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Business Categories</h2>
            <ul class="categories-list">
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
