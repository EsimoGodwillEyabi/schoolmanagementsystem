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
    if (empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['email'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: add_teacher.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
   

    // Store password as plain text
    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO teacher (name, description, image) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $description, $image);
        if (mysqli_stmt_execute($stmt)) {
            // Success - set the session message and redirect back
            $_SESSION['success_message'] = "Teacher added successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_teacher.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error adding student: " . mysqli_stmt_error($stmt);
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