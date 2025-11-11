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
            <h2>Add Course</h2>

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

                    <form action="course_data_check.php" method="post" novalidate>
                        <!-- send usertype so server knows this is a student account -->
                        <input type="hidden" name="usertype" value="student">
                        <div>
                            <label>course_name</label>
                            <input type="text" name="course_name" required>
                        </div>
                         <div>
                            <label>course_code</label>
                            <input type="text" name="course_code"  required>
                        </div>
                         <div>
                            <label>teacher_id</label>
                            <input type="text" name="teaccher_id" required>
                        </div>
                         <div>
                             <button type="submit" class="btn btn-primary" name="submit">Add Course</button>
                         
                    </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>