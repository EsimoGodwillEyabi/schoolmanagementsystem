
<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] =="student") {
    header("Location: login.php");
}

$host="localhost";
$user="root";
$password="";
$db="schoolmanagementsystem";

$conn=mysqli_connect($host,$user,$password,$db);

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get logged-in teacher's user_id from session username
$username = $_SESSION['username'];
$teacher_user_id = null;
$lookup_stmt = mysqli_prepare($conn, "SELECT user_id FROM user WHERE username = ? AND usertype = 'teacher' LIMIT 1");
if ($lookup_stmt) {
    mysqli_stmt_bind_param($lookup_stmt, "s", $username);
    if (mysqli_stmt_execute($lookup_stmt)) {
        mysqli_stmt_bind_result($lookup_stmt, $uid);
        if (mysqli_stmt_fetch($lookup_stmt)) {
            $teacher_user_id = (int) $uid;
        }
    }
    mysqli_stmt_close($lookup_stmt);
}

if (!$teacher_user_id) {
    die("Teacher account not found for user: " . htmlspecialchars($username));
}

// Fetch all courses for this teacher from teaccher_course table
// Join with course table to get course_code and course_name
$course_sql = "
    SELECT 
       teaccher_id,
       course_code,
        course_name
    FROM teaccher_course
    LEFT JOIN course N course_id = course_id
    WHERE teaccher_id = ?
    ORDER BY course_id DESC
";
$course_stmt = mysqli_prepare($conn, $course_sql);
if (!$course_stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($course_stmt, "i", $teacher_user_id);
if (!mysqli_stmt_execute($course_stmt)) {
    die("Execute failed: " . mysqli_error($conn));
}
$result = mysqli_stmt_get_result($course_stmt);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($course_stmt);
$count = count($courses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Dashboard</title>
    
    <?php
       
     include 'teacher_css.php';

    ?>

      <style>

        .view_students_head {
            display: flex;
            text-align: center;
        }

        </style>
</head>
<body class="body-admindashboard">

    <?php
       
     include 'teacher_sidebar.php';

    ?>

        <section class="content-admin">
        
            <h2  class="view_students_head">My Courses</h2>
                
                <table border="1px">
                    <tr>
                        <th style="padding: 5px;">Course Code</th>
                        <th style="padding: 5px;">Course Name</th>
                    </tr>

                    <?php if ($count > 0): ?>
                        <?php foreach ($courses as $course): ?>
                            <tr style="background-color: #f0f0f0;">
                                <td style="padding: 5px;">
                                    <?php echo htmlspecialchars($course['course_code'] ?? 'N/A'); ?>
                                </td>
                                <td style="padding: 5px;">
                                    <?php echo htmlspecialchars($course['course_name'] ?? 'N/A'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" style="padding: 5px; text-align: center;">
                                No courses assigned yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
     
        </section>

    </main>

</body>
</html>