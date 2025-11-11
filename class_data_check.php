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
    header("Location: add_class.php");
    exit();
}

// Check if course was added (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['class_name']) || empty($_POST['year'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: add_class.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $class_name = mysqli_real_escape_string($conn, $_POST['class_name']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    
    // Store password as plain text
    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO class (class_name, year) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $class_name, $year);
        if (mysqli_stmt_execute($stmt)) {
            // Success - session message and redirect back
            $_SESSION['success_message'] = "Class added successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_class.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error adding student: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_class.php");
            exit();
        }
    } else {
        // Prepare failed
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: add_class.php");
        exit();
    }

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: add_class.php");
    exit();
}
?>