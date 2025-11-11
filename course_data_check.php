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
    header("Location: add_course.php");
    exit();
}

// Check if course was added (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['course_name']) || empty($_POST['course_code'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: add_course.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $teacher_id = mysqli_real_escape_string($conn, $_POST['teaccher_id']);
    
    // Store password as plain text
    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO coursse (course_name, course_code, teaccher_id) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $course_name, $course_code, $teacher_id);
        if (mysqli_stmt_execute($stmt)) {
            // Success - set the session message and redirect back
            $_SESSION['success_message'] = "Course added successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_course.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error adding student: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: add_course.php");
            exit();
        }
    } else {
        // Prepare failed
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: add_course.php");
        exit();
    }

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: add_course.php");
    exit();
}
?>