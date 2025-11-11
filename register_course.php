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
    die("Database connection failed: " . mysqli_connect_error());
}

// Get list of available courses
$sql = "SELECT course_name, course_code FROM coursse ORDER BY course_name ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching courses: " . mysqli_error($conn));
}

$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get list of available accademic years
$sql = "SELECT first_semester, second_semester FROM accademic_years ORDER BY year_id ASC";
$year_result = mysqli_query($conn, $sql);

if (!$year_result) {
    die("Error fetching courses: " . mysqli_error($conn));
}

$accademic_years = mysqli_fetch_all($year_result, MYSQLI_ASSOC);

// Get list of available semesters
$sql = "SELECT first_semester, second_semester FROM semester ORDER BY semester_id ASC";
$semester_result = mysqli_query($conn, $sql);

if (!$semester_result) {
    die("Error fetching courses: " . mysqli_error($conn));
}

$semester = mysqli_fetch_all($semester_result, MYSQLI_ASSOC);

// Get current student's id to include in the form as a hidden field
$student_id = null;
$username = $_SESSION['username'];
$student_q = mysqli_prepare($conn, "SELECT user_id FROM user WHERE username = ?");
if ($student_q) {
    mysqli_stmt_bind_param($student_q, "s", $username);
    mysqli_stmt_execute($student_q);
    mysqli_stmt_bind_result($student_q, $sid);
    mysqli_stmt_fetch($student_q);
    mysqli_stmt_close($student_q);
    $student_id = $sid;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Course - Student Dashboard</title>

    <style>
         label {
           display: inline-block;
           text-align: right;
           width: 100px;
           padding-top: 10px;
           padding-bottom: 10px;
         }
        .student_submit_button {
          background-color: skyblue;
          border-radius: 2px;
           width:50%;
           padding:4px 6px;
           border-radius:4px;
           border:1px solid #e6efe6;
            font-size:12px;
            height:24px
            margin: 2px;
        }
        .btn{padding:4px 10px;border-radius:4px;border:0;cursor:pointer;font-weight:500;font-size:12px}
        .btn-primary{background:green;color:#fff}

        /* Alert Messages */
        .alert {
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: left;
            width: 80%;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .input-hint {
            font-size: 11px;
            color: #666;
            margin-top: 2px;
            text-align: left;
            margin-left: 105px;
        }
    </style>
    
      <?php include 'student_css.php'; ?>
</head>
<body class="body-admindashboard">

      <?php include 'student_sidebar.php'; ?>
      
 <center>
        <section class="content-admin">
            <h2>Register Course</h2>

            <div>
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success">
                        <?php 
                            echo htmlspecialchars($_SESSION['success_message']);
                            unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-error">
                        <?php 
                            echo htmlspecialchars($_SESSION['error_message']);
                            unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="register_course_check.php" method="post" novalidate>
                    <!-- Hidden student id (populated from session lookup) -->
                    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
                    <div>
                        <label for="course">Select Course</label>
                        <select name="course_id" id="course" required>
                            <option value="">-- Select a Course --</option>
                            <?php foreach($courses as $course): ?>
                                <option value="<?php echo htmlspecialchars($course['course_code']); ?>">
                                    <?php echo htmlspecialchars($course['course_code'] . ' - ' . $course['course_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-hint">Choose the course you want to register for</div>
                    </div>
                    <div>
                        <label for="accademic_year">Academic Year</label>
                        <select name="year_id" id="accademic_year" required>
                            <option value="">-- Select Academic Year --</option>
                            <?php foreach($accademic_years as $ay): ?>
                                <option value="<?php echo htmlspecialchars($ay['first_semester']); ?>">
                                    <?php echo htmlspecialchars($ay['first_semester'] . ' - ' . $ay['second_semester']); ?>
                            <?php endforeach; ?>
                        </select>
                        </select>
                        <div class="input-hint">Choose the accademic you are registering for</div>
                     </div>
                    </div>
                     <div>
                        <label for="semester">Select Semester</label>
                        <select name="semester_id" id="semester" required>
                            <option value="">-- Select a semester --</option>
                            <?php foreach($semester as $se): ?>
                                <option value="<?php echo htmlspecialchars($se['first_semester']); ?>">
                                    <?php echo htmlspecialchars($se['first_semester']); ?>
                                     <?php echo htmlspecialchars($se['second_semester']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-hint">Choose the Semester you want to register for</div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit">Register Course</button>
                    </div>
                </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>