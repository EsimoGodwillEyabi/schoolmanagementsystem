<?php
session_start();

// Verify user is logged in and is a student
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if($_SESSION['usertype'] !== "student") {
    header("Location: login.php");
    exit();
}

// Check if form was submitted (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: register_course.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementsystem";

$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$conn) {
    $_SESSION['error_message'] = "Database connection failed: " . mysqli_connect_error();
    header("Location: register_course.php");
    exit();
}

// --- 1. RECEIVE AND VALIDATE INPUTS ---
// The form (register_course.php) is now sending numeric IDs.
$course_code = isset($_POST['course_code']) ? (int) $_POST['course_code'] : 0;
$year_id = isset($_POST['year_id']) ? (int) $_POST['year_id'] : 0;
$semester_id = isset($_POST['semester_id']) ? (int) $_POST['semester_id'] : 0;

if ($course_code === 0 || $year_id === 0 || $semester_id === 0) {
    $_SESSION['error_message'] = "All required fields (Course, Academic Year, and Semester) must be selected.";
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();
}

// --- 2. SECURELY GET STUDENT ID FROM SESSION/DB ---
$username = $_SESSION['username'];
$student_id = null;
$student_query = mysqli_prepare($conn, "SELECT user_id FROM user WHERE username = ? LIMIT 1");

if ($student_query) {
    mysqli_stmt_bind_param($student_query, "s", $username);
    mysqli_stmt_execute($student_query);
    mysqli_stmt_bind_result($student_query, $sid);
    mysqli_stmt_fetch($student_query);
    mysqli_stmt_close($student_query);
    $student_id = $sid;
}

if (empty($student_id)) {
    $_SESSION['error_message'] = "Could not determine your student account.";
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();
}

// --- 3. PREVENT DUPLICATE REGISTRATION ---
// Check for same student, same course, same year, AND same semester
$check_sql = "SELECT COUNT(*) FROM studdent_course WHERE student_id = ? AND course_code = ? AND year_id = ? AND semester_id = ?";
$check_stmt = mysqli_prepare($conn, $check_sql);

if (!$check_stmt) {
    $_SESSION['error_message'] = "Database error (check prep): " . mysqli_error($conn);
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();
}

mysqli_stmt_bind_param($check_stmt, "iiii", $student_id, $course_code, $year_id, $semester_id); 
mysqli_stmt_execute($check_stmt);
mysqli_stmt_bind_result($check_stmt, $cnt);
mysqli_stmt_fetch($check_stmt);
mysqli_stmt_close($check_stmt);

if ($cnt > 0) {
    $_SESSION['error_message'] = "You are already registered for this course in the selected academic year and semester.";
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();
}

// --- 4. INSERT REGISTRATION INTO studdent_course TABLE (The requested action) ---
$insert_sql = "INSERT INTO studdent_course (student_id, course_code, year_id, semester_id) VALUES (?, ?, ?, ?)";
$insert_stmt = mysqli_prepare($conn, $insert_sql);

if (!$insert_stmt) {
    $_SESSION['error_message'] = "Database error (insert prep): " . mysqli_error($conn);
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();
}

mysqli_stmt_bind_param($insert_stmt, "iiii", $student_id, $course_code, $year_id, $semester_id); 
$ok = mysqli_stmt_execute($insert_stmt);

// --- 5. DISPLAY MESSAGE AND REDIRECT (The requested action) ---
if ($ok) {
    // This message will be displayed on register_course.php after redirect
    $_SESSION['success_message'] = "**Course registration done successfully!**"; 
} else {
    $_SESSION['error_message'] = "Error registering for course: " . mysqli_stmt_error($insert_stmt);
}

mysqli_stmt_close($insert_stmt);
mysqli_close($conn);
header("Location: register_course.php");
exit();
?>