
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

//Selecting data from mysql
// Order by `user_id` (table uses `user_id` column) to avoid errors if `id` doesn't exist
$sql = "SELECT * FROM user WHERE usertype = 'student' ORDER BY user_id DESC";

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
        
            <h2  class="view_students_head">Students</h2>
                
                <table border="1px">
                    <tr>
                        <th style="padding: 5px;">username</th>
                        <th style="padding: 5px;">phone</th>
                        <th style="padding: 5px;">email</th>
                        <th style="padding: 5px;">password</th>
                    </tr>

                    <?php

                    while($info = mysqli_fetch_assoc($result)) {
                    ?>    
                    
                        <tr style="background-color: blue; max-width: 100px;">
                            <td style="padding: 5px;">
                                <?php echo "{$info['username']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['phone']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['email']}"; ?>
                            </td>
                            <td style="padding: 5px;">
                                <?php echo "{$info['password']}"; ?>
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