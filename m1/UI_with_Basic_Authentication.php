<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberpunk Login</title>
    <style>
        body {
            background: #0d1117;
            color: #39ff14;
            font-family: 'Courier New', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px #39ff14;
        }
        input {
            background: #222;
            border: 1px solid #39ff14;
            color: #39ff14;
            padding: 10px;
            margin: 5px;
            width: 100%;
            text-align: center;
        }
        button {
            background: #39ff14;
            color: #0d1117;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cyberpunk Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        define('USERNAME', 'admin');
        const PASSWORD = '12345';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_username = $_POST['username'] ?? '';
            $_password = $_POST['password'] ?? '';
            
            if ($_username === USERNAME && $_password === PASSWORD) {
                echo '<p class="success">Login successful!</p>';
            } else {
                echo '<p class="error">Invalid Username or Password</p>';
            }
        }
        ?>
    </div>
</body>
</html>
