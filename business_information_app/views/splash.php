<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .splash-screen {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .splash-screen img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .splash-screen h1 {
            font-size: 24px;
            color: #333333;
            margin: 10px 0;
        }

        .splash-screen p {
            font-size: 16px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="splash-screen">
        <img src="../assets/images/logo.png" alt="Logo">
        <h1>Welcome to Business Information App</h1>
        <p>Loading...</p>
        <script>
            setTimeout(function() {
                window.location.href = 'views/login.php';
            }, 3000); // Redirects after 3 seconds
        </script>
    </div>
</body>
</html>
