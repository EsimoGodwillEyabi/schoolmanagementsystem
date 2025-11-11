
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
$sql = "SELECT * FROM coursse ORDER BY course_id DESC";

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
    <title>Admin Dashboard</title>
    
    <?php
       
     include 'admin_css.php';

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
       
     include 'admin_sidebar.php';

    ?>

        <section class="content-admin">
        
            <h2  class="view_students_head">Course</h2>
                
                <table border="1px">
                    <tr>
                        <th style="padding: 5px;">course_id</th>
                        <th style="padding: 5px;">course_name</th>
                        <th style="padding: 5px;">course_code</th>
                        <th style="padding: 5px;">teacher_id</th>
                    </tr>

                    <?php

                    while($info=$result->fetch_assoc())
                    {
                    ?>    
                        
                        <tr style="background-color: blue; max-width: 100px;">
                            <td style="padding: 5px;">
                                <?php echo "{$info['course_id']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['course_name']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['course_code']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['teaccher_id']}"; ?>
                            </td>
                        </tr>

                    <?php

                    }

                    ?>
                </table>
     
        </section>

    </main>

</body>
</html>