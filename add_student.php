<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] =="student") {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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
        .btn-primary{background:blue;color:#fff}
    </style>
    
      <?php
       
       include 'admin_css.php'

      ?>
</head>
<body class="body-admindashboard">

      <?php
       
       include 'admin_sidebar.php'

      ?>
 <center>
        <section class="content-admin">
            <h2>Add Student</h2>
            

            <div>

                    <form action="student_data_check.php" method="post" novalidate>
                        <!-- send usertype so server knows this is a student account -->
                        <input type="hidden" name="usertype" value="student">

                        <div>
                            <label>Username</label>
                            <input type="text" name="username">
                        </div>
                         <div>
                            <label>Phone</label>
                            <input type="number" name="phone">
                        </div>
                         <div>
                            <label>Email</label>
                            <input type="email" name="email">
                        </div>
                         <div>
                            <label>Password</label>
                            <input type="text" name="password">
                        </div>
                         <div>
                             <button type="submit" class="btn btn-primary" name="submit">Add student</button>
                         
                    </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>