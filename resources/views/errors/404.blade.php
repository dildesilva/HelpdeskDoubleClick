<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - DoubleClick</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .error-page {
            text-align: center;
            padding: 20px;
        }
        .error-page img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .error-page h1 {
            font-size: 3em;
            color: #ff6f61;
            margin: 10px 0;
        }
        .error-page p {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .error-page a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .error-page a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <img src="{{ asset('img/image.png') }}" alt="DoubleClick Logo">
        <h1>404 - Page Not Found</h1>
        <p>Oops! The page you are looking for doesn't exist.</p>
        <p>It seems you've found yourself in the wrong place. Let's get you back on track.</p>
        <a href="javascript:history.back()">Go Back</a>

    </div>
</body>
</html>
