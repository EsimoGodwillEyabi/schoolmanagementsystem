<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementsystem";

// Create connection using mysqli_connect instead of mysqli
$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$conn) {
    $_SESSION['error_message'] = "Database connection failed: " . mysqli_connect_error();
    header("Location: add_student.php");
    exit();
}

// Check if student was added (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: add_student.php");
        exit();
    }

    // Validate username length and format
    $username = trim($_POST['username']);
    if (strlen($username) < 3 || strlen($username) > 30 || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $_SESSION['error_message'] = "Username must be 3-30 characters long and can only contain letters, numbers, and underscores";
        header("Location: add_student.php");
        exit();
    }

    // Validate phone number format (must be numbers, +, -, minimum 10 digits)
    $phone = trim($_POST['phone']);
    if (!preg_match('/^[+]?[\d\s-]{10,}$/', $phone)) {
        $_SESSION['error_message'] = "Please enter a valid phone number (minimum 10 digits)";
        header("Location: add_student.php");
        exit();
    }

    // Validate email format
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Please enter a valid email address";
        header("Location: add_student.php");
        exit();
    }

    // Validate password strength
    $password = $_POST['password'];
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password)) {
        $_SESSION['error_message'] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
        header("Location: add_student.php");
        exit();
    }

    // Check for duplicate email
    $check_email = mysqli_prepare($conn, "SELECT COUNT(*) FROM user WHERE email = ?");
    mysqli_stmt_bind_param($check_email, "s", $_POST['email']);
    mysqli_stmt_execute($check_email);
    mysqli_stmt_bind_result($check_email, $email_count);
    mysqli_stmt_fetch($check_email);
    mysqli_stmt_close($check_email);

    if ($email_count > 0) {
        $_SESSION['error_message'] = "This email address is already registered";
        header("Location: add_student.php");
        exit();
    }

    // Check for duplicate username
    $check_username = mysqli_prepare($conn, "SELECT COUNT(*) FROM user WHERE username = ?");
    mysqli_stmt_bind_param($check_username, "s", $_POST['username']);
    mysqli_stmt_execute($check_username);
    mysqli_stmt_bind_result($check_username, $username_count);
    mysqli_stmt_fetch($check_username);
    mysqli_stmt_close($check_username);

    if ($username_count > 0) {
        $_SESSION['error_message'] = "This username is already taken";
        header("Location: add_student.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype'] ?? 'student');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

    // Store password as plain text
    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO user (username, phone, email, usertype, password) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $username, $phone, $email, $usertype, $password);
        if (mysqli_stmt_execute($stmt)) {
            // Success - set the session message and redirect back
            $_SESSION['success_message'] = "Student added successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_student.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error adding student: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_student.php");
            exit();
        }
    } else {
        // Prepare failed
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: add_student.php");
        exit();
    }

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: add_student.php");
    exit();
}
?>