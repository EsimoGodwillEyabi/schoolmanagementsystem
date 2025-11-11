
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
$sql = "SELECT studdent_id FROM teaccher_course ORDER BY id DESC";

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
        
            <h2  class="view_students_head">My Students</h2>
                
                <table border="1px">
                    <tr>
                        <th style="padding: 5px;">course_code</th>
                    </tr>

                    <?php

                    while($info=$result->fetch_assoc())
                    {
                    ?>    
                        
                        <tr style="background-color: blue; max-width: 100px;">
                            <td style="padding: 5px;">
                                <?php echo "{$info['studdent_id']}"; ?>
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