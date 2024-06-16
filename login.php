<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary, .btn-danger {
            width: 100%;
            margin-top: 10px;
        }
        .btn-danger {
            margin-bottom: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="checklogin.php" method="POST">
            <h2>Login</h2>
            <!-- NAME TEXTBOX -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required="required" class="form-control" placeholder="Enter Username">
            </div>

            <!-- PASSWORD TEXTBOX -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required="required" class="form-control" placeholder="Enter Password">
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="index.php" class="btn btn-danger">Back</a>
            <p>Not registered yet? <a href="register.php">Register Here</a></p>
        </form>
    </div>
</body>
</html>
