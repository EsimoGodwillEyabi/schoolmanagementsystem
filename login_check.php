
<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementsystem";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    // Username can be escaped for safety, but do NOT escape the password prior to verification
    // because escaping alters the original password string and breaks password_verify()
    $name = mysqli_real_escape_string($data, trim($_POST['username'] ?? ''));
    $pass = trim($_POST['password'] ?? '');

    if (empty($name) || empty($pass)) {
        $_SESSION['LoginMessage'] = "Please enter both username and password.";
        header("Location: login.php");
        exit();
    }

    // Use prepared statement to fetch user by username
    $stmt = mysqli_prepare($data, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $storedPassword = $row['password'];

            // Direct password comparison
        $passwordValid = ($pass === $storedPassword);

        if ($passwordValid) {
            // Valid login
            $_SESSION['username'] = $name;
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['user_id'] = $row['id']; // Store user ID if you have it
            
            // Clear any existing error messages
            unset($_SESSION['LoginMessage']);
            
            if ($row["usertype"] == "student") {
                header("Location: studenthome.php");
            } elseif ($row["usertype"] == "admin") {
                header("Location: adminhome.php");
            } 
            elseif ($row["usertype"] == "teacher") {
                header("Location: teacher.php");
            } else {
                $_SESSION['LoginMessage'] = "Invalid user type.";
                header("Location: login.php");
            }
        } else {
            // Invalid login
            $_SESSION['LoginMessage'] = "Invalid username or password.";
            header("Location: login.php");
        }
    } else {
        // Invalid login
        $_SESSION['LoginMessage'] = "Invalid username or password.";
        header("Location: login.php");
    }
    
    mysqli_stmt_close($stmt);
    exit();
}
?>