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
    header("Location: admissionform.php");
    exit();
}

// Check if form was submitted (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
        $_SESSION['error_message'] = "Please fill in all required fields";
        header("Location: admissionform.php");
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $dob = mysqli_real_escape_string($conn, $_POST['dob'] ?? '');
    $program = mysqli_real_escape_string($conn, $_POST['program'] ?? '');
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    $notes = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');

    // Combine program and notes into a single additional_information field (adjust if your DB has a separate program column)
    $additional_information = trim(($program ? "Program: {$program}" : '') . ($notes ? "\nNotes: {$notes}" : ''));

    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO admissionform (firstname, lastname, email, phone, dateofbirth, address, addin) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $email, $phone, $dob, $address, $additional_information);
        if (mysqli_stmt_execute($stmt)) {
            // Success - set the session message keys admissionform.php expects and redirect back
            $_SESSION['success_message'] = "Application submitted successfully!";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: admissionform.php");
            exit();
        } else {
            // Execution failed
            $_SESSION['error_message'] = "Error submitting application: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: admissionform.php");
            exit();
        }
    } else {
        // Prepare failed
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admissionform.php");
        exit();
    }

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: admissionform.php");
    exit();
}
?>