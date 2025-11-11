<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login Form</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body background="assets/aboutusmission.jpg" class="bg-image">
    <style>
        .form-design {
            display: inline-block;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top: 100px;
        }
        .form-group {
            display: flex;
            flex-direction: row;
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            color: red;
            font-size: 16px;
        }
        .form-design input[type="text"],
        .form-design input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-design input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-design input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    
    <center>
    <div class="form-design">
        <form action="login_check.php" method="POST">
            <div class="form-header">
                <h2>Login Form</h2>
                <h3> 
                    <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 0);
                        session_start();
                        
                        // Display and clear any login messages
                        $message = isset($_SESSION['LoginMessage']) ? $_SESSION['LoginMessage'] : '';
                        unset($_SESSION['LoginMessage']);
                        echo htmlspecialchars($message);
                    ?>
                </h3>
            </div>
            <!-- Add CSRF token -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
            
            <div class="form-group">
                <label class="form-label" for="username">Username:</label>
                <input type="text" name="username" id="username" required autocomplete="username">            
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password:</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
            </div>
            <div>
                <input class="btn btn-primary" type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
</center>
</body>
</html>