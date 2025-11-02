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
           
           padding-top: 10px;
           padding-bottom: 10px;
         }
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

                    <form>
                        
                        <div>
                            <label>Username</label>
                            <input type="text" name="firstname">
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
                            <input type="submit" name="add_student" value="Add Student">
                        </div>
                         
                    </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>