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
    header("Location: add_teacher.php");
    exit();
}

// Check if teacher was added (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['teacher_id']) || empty($_POST['full_name']) || empty($_POST['description']) || empty($_POST['phone']) || empty($_POST['email'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: add_teacher.php");
        exit();
    }

    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Please enter a valid email address";
        header("Location: add_teacher.php");
        exit();
    }

    // Validate phone number format (must be numbers, +, -, minimum 10 digits)
    $phone = trim($_POST['phone']);
    if (!preg_match('/^[+]?[\d\s-]{10,}$/', $phone)) {
        $_SESSION['error_message'] = "Please enter a valid phone number (minimum 10 digits)";
        header("Location: add_teacher.php");
        exit();
    }

    // Check for duplicate email
    $check_email = mysqli_prepare($conn, "SELECT COUNT(*) FROM teacher WHERE email = ?");
    mysqli_stmt_bind_param($check_email, "s", $_POST['email']);
    mysqli_stmt_execute($check_email);
    mysqli_stmt_bind_result($check_email, $email_count);
    mysqli_stmt_fetch($check_email);
    mysqli_stmt_close($check_email);

    if ($email_count > 0) {
        $_SESSION['error_message'] = "This email address is already registered";
        header("Location: add_teacher.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $teacher_id = mysqli_real_escape_string($conn, $_POST['teacher_id']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
   
    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO teaccher (teaccher_id, fullname, description, phone, email) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $teacher_id, $full_name, $description, $phone, $email);
        if (mysqli_stmt_execute($stmt)) {
            // Success - set the session message and redirect back
            $_SESSION['success_message'] = "Teacher added successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_teacher.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error adding teacher: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_teacher.php");
            exit();
        }
    } else {
        // Prepare failed
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: add_teacher.php");
        exit();
    }

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: add_teacher.php");
    exit();
}
?>