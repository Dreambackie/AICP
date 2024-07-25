<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Login</h1>
    </header>

    <main>
        <section>
            <form action="verify_login.php" method="post">
                <label for="password">Enter Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 BuzConnect</p>
    </footer>
</body>
</html>
