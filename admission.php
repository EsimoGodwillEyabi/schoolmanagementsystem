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
$sql = "SELECT * FROM admissionform ORDER BY id DESC"; // Assuming you have an id column, ordering by newest first

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
    <title>Applied For Admission</title>
    <?php
    include 'admin_css.php';
?>
<body style="margin: 0px";>
    <main>
            <?php

            include 'admin_sidebar.php'

            ?>
    <center>

        <section class="content-admin">
            <h2>Applied For Admission</h2>

            <table border="1px">
                <tr>
                    <th style="padding: 5px;">firstname</th>
                    <th style="padding: 5px;">lastname</th>
                    <th style="padding: 5px;">email</th>
                    <th style="padding: 5px;">phone</th>
                    <th style="padding: 5px;">address</th>
                    <th style="padding: 5px;">additionalinformation</th>
                </tr>

                <?php

                while($info=$result->fetch_assoc())
                {
                ?>    
                
                    <tr style="background-color: blue";>
                        <td style="padding: 5px;">
                            <?php echo "{$info['firstname']}"; ?>
                        </td>
                        <td style="padding: 5px;">
                            <?php echo "{$info['lastname']}"; ?>
                        </td>
                        <td style="padding: 5px;">
                            <?php echo "{$info['email']}"; ?>
                        </td>
                        <td style="padding: 5px;">
                            <?php echo "{$info['phone']}"; ?>
                        </td>
                        <td style="padding: 5px;">
                            <?php echo "{$info['address']}"; ?>
                        </td>
                         <td style="padding: 5px;">
                            <?php echo "{$info['addin']}"; ?>
                        </td>
                    </tr>

                <?php

                }

                ?>
            </table>
        </section>

      </main>
    </center>
</body>
</html>