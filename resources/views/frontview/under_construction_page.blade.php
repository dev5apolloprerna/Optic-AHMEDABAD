<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optic Exhibition | Under Construction</title>
    <style>
        body {
            background-color: #0a0a0a;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            background: linear-gradient(135deg, #0a0a0a, #1b1b1b);
        }
        .container {
            max-width: 600px;
            padding: 20px;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #ccc;
        }
        .logo {
            width: 120px;
            margin-bottom: 20px;
        }
        .spinner {
            border: 5px solid rgba(255,255,255,0.2);
            border-top: 5px solid #00bcd4;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin: 20px auto;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
        footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #888;
        }
        a {
            color: #00bcd4;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://opticexhibition.com/logo.png" alt="Optic Exhibition Logo" class="logo">
        <h1>We're Under Construction</h1>
        <p>Our website is currently undergoing scheduled maintenance.<br>
        We’ll be back very soon with something amazing!</p>
        <div class="spinner"></div>
        <footer>
            © <span id="year"></span> Optic Exhibition. All rights reserved. <br>
            <a href="mailto:info@opticexhibition.com">info@opticexhibition.com</a>
        </footer>
    </div>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
