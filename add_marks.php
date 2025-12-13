
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

//Selecting data from mysql
// Order by `course_id` (table uses `course_id` column) to avoid errors if `id` doesn't exist

// Handle bulk mark update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_marks'])) {
    if (isset($_POST['score']) && isset($_POST['grade']) && isset($_POST['marrk_id'])) {
        foreach ($_POST['marrk_id'] as $idx => $marrk_id) {
            $score = floatval($_POST['score'][$idx]);
            $grade = mysqli_real_escape_string($conn, $_POST['grade'][$idx]);
            $marrk_id = intval($marrk_id);
            $update_sql = "UPDATE marrks SET score=?, grade=? WHERE marrk_id=?";
            $stmt = $conn->prepare($update_sql);
            if ($stmt) {
                $stmt->bind_param('dsi', $score, $grade, $marrk_id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}

$sql = "SELECT * FROM marrks WHERE teaccher_id = 'FT2A2'  ORDER BY marrk_id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    
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
        
            <h2  class="view_students_head">Add Marks</h2>
                
                <form method="POST" action="">
                <table border="1px">
                    <tr>
                        <th style="padding: 5px;">marrk_id</th>
                        <th style="padding: 5px;">student_id</th>
                        <th style="padding: 5px;">Teachr_id</th>
                        <th style="padding: 5px;">course_code</th>
                        <th style="padding: 5px;">year_id</th>
                        <th style="padding: 5px;">score</th>
                        <th style="padding: 5px;">grade</th>
                    </tr>

                    <?php
                    while($info=$result->fetch_assoc())
                    {
                    ?>
                        <tr style="max-width: 100px;">
                            <td style="padding: 5px;">
                                <?php echo htmlspecialchars($info['marrk_id']); ?>
                                <input type="hidden" name="marrk_id[]" value="<?php echo htmlspecialchars($info['marrk_id']); ?>">
                            </td>
                            <td style="padding: 5px;">
                                <?php echo htmlspecialchars($info['studdent_id']); ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo htmlspecialchars($info['teaccher_id']); ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo htmlspecialchars($info['course_code']); ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo htmlspecialchars($info['year_id']); ?>
                            </td>
                            <td style="padding: 5px;">
                                <input type="number" step="0.01" name="score[]" value="<?php echo htmlspecialchars($info['score']); ?>" required>
                            </td>
                            <td style="padding: 5px;">
                                <input type="text" name="grade[]" value="<?php echo htmlspecialchars($info['grade']); ?>" required>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <br>
                <button type="submit" name="update_marks">Update Marks</button>
                </form>
     
        </section>

    </main>

</body>
</html>