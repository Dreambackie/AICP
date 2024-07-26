<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add City or Town</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add City or Town</h1>
    </header>
    
    <main>
        <section>
            <h2>Add a New City or Town</h2>
            <form action="insert_city.php" method="post">
                <label for="city_name">City Name:</label>
                <input type="text" id="city_name" name="city_name" required>
                <input type="submit" value="Add City">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 BizConnect</p>
    </footer>
</body>
</html>
