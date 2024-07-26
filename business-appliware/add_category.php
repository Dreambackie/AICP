<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Business Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add Business Category</h1>
    </header>
    
    <main>
        <section>
            <h2>Add a New Business Category</h2>
            <form action="insert_category.php" method="post">
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
                <input type="submit" value="Add Category">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024  BizConnect</p>
    </footer>
</body>
</html>
