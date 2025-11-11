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

// Check if course was registered (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Expecting: student_id (hidden), course_code, year_id
    $posted_student_id = isset($_POST['student_id']) ? (int) $_POST['student_id'] : null;
    $raw_course = isset($_POST['course_code']) ? trim($_POST['course_code']) : null;
    $raw_year = isset($_POST['year_id']) ? trim($_POST['year_id']) : null;

    // Normalize course_id: the form may send a course_id (int) or a course_code string
    $course_code = null;
    if ($raw_course !== null && $raw_course !== '') {
        if (is_numeric($raw_course)) {
            $course_code = (int) $raw_course;
        } else {
            // Lookup course_id by code or name
            $cstmt = mysqli_prepare($conn, "SELECT course_code FROM coursse WHERE course_code = ? OR course_name = ? LIMIT 1");
            if ($cstmt) {
                mysqli_stmt_bind_param($cstmt, "ss", $raw_course, $raw_course);
                mysqli_stmt_execute($cstmt);
                mysqli_stmt_bind_result($cstmt, $found_course_id);
                mysqli_stmt_fetch($cstmt);
                mysqli_stmt_close($cstmt);
                if (!empty($found_course_id)) {
                    $course_code = (int) $found_course_id;
                }
            }
        }
    }

    // Normalize year_id: form may send a year label (first_semester) instead of numeric id
    $year_id = null;
    if ($raw_year !== null && $raw_year !== '') {
        if (is_numeric($raw_year)) {
            $year_id = (int) $raw_year;
        } else {
            $ystmt = mysqli_prepare($conn, "SELECT year_id FROM accademic_years WHERE first_semester = ? OR second_semester = ? LIMIT 1");
            if ($ystmt) {
                mysqli_stmt_bind_param($ystmt, "ss", $raw_year, $raw_year);
                mysqli_stmt_execute($ystmt);
                mysqli_stmt_bind_result($ystmt, $found_year_id);
                mysqli_stmt_fetch($ystmt);
                mysqli_stmt_close($ystmt);
                if (!empty($found_year_id)) {
                    $year_id = (int) $found_year_id;
                }
            }
        }
    }

    if (empty($course_code) || empty($year_id)) {
        $_SESSION['error_message'] = "Please select a course and academic year.";
        header("Location: register_course.php");
        exit();
    }

    // Determine student id from session (ignore posted value for security)
    $username = $_SESSION['username'];
    $student_query = mysqli_prepare($conn, "SELECT user_id FROM user WHERE username = ? LIMIT 1");
    if (!$student_query) {
        $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
        header("Location: register_course.php");
        exit();
    }
    mysqli_stmt_bind_param($student_query, "s", $username);
    mysqli_stmt_execute($student_query);
    mysqli_stmt_bind_result($student_query, $student_id);
    mysqli_stmt_fetch($student_query);
    mysqli_stmt_close($student_query);

    if (empty($student_id)) {
        $_SESSION['error_message'] = "Could not determine your student account.";
        header("Location: register_course.php");
        exit();
    }

    // Prevent duplicate registration: same student, same course, same year
    $check_sql = "SELECT COUNT(*) FROM studdent_course WHERE student_id = ? AND course_code = ? AND year_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    if (!$check_stmt) {
        $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
        header("Location: register_course.php");
        exit();
    }
    mysqli_stmt_bind_param($check_stmt, "iii", $student_id, $course_code, $year_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $cnt);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt);

    if ($cnt > 0) {
        $_SESSION['error_message'] = "You are already registered for this course in the selected academic year.";
        header("Location: register_course.php");
        exit();
    }

    // Insert registration
    $registration_date = date('Y-m-d H:i:s');
    $insert_sql = "INSERT INTO studdent_course (student_id, course_code, year_id, semester) VALUES (?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_sql);
    if (!$insert_stmt) {
        $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
        header("Location: register_course.php");
        exit();
    }
    mysqli_stmt_bind_param($insert_stmt, "iiis", $student_id, $course_code, $year_id, $semester);
    $ok = mysqli_stmt_execute($insert_stmt);
    if ($ok) {
        $_SESSION['success_message'] = "Course registration successful!";
    } else {
        $_SESSION['error_message'] = "Error registering for course: " . mysqli_stmt_error($insert_stmt);
    }
    mysqli_stmt_close($insert_stmt);
    mysqli_close($conn);
    header("Location: register_course.php");
    exit();

} else {
    // If accessed directly without form submission
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: register_course.php");
    exit();
}
?>