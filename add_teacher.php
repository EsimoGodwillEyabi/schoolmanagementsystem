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
        .btn{padding:8px 30px;border-radius:4px;border:0;cursor:pointer;font-weight:500;font-size:12px}
        .btn-primary{background:orange;color:#fff; margin-left: 100px}
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
            <h2>Add Teacher</h2>
            

            <div>

                    <form action="teacher_data_check.php" method="post" novalidate>
                        <!-- send usertype so server knows this is a student account -->
                        <input type="hidden" name="usertype" value="student">

                        <div>
                            <label>name</label>
                            <input type="text" name="name">
                        </div>
                         <div>
                            <label>description</label>
                            <input type="text" name="description">
                        </div>
                         <div>
                            <label>image</label>
                            <input type="imagr" name="image">
                        </div>
                         <div>
                             <button type="submit" class="btn btn-primary" name="submit">Add teacher</button>
                         
                    </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>