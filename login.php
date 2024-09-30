
<?
include "php/login.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate System - Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 400px; margin: 100px auto; }
        .form-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 15px; background-color: #5cb85c; color: white; border: none; width: 100%; cursor: pointer; }
        button:hover { background-color: #4cae4c; }
        .message { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Certificate System - Login</h2>
            <form method="POST" action="login.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>