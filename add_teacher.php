<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] !=="admin") {
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
           justify-content: center;
           max-width: 100px;
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

        /* Alert Messages */
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: left;
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

            <div class="add_teacherform_style">
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

                    <form action="teacher_data_check.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label>Teacher_id</label>
                            <input type="text" name="teacher_id" required>
                        </div>
                        <div>
                            <label>fullname</label>
                            <input type="text" name="full_name" required>
                        </div>
                        <div>
                            <label>description</label>
                            <textarea name="description" rows="3" required></textarea>
                        </div>
                        <div>   
                            <label>phone</label>
                            <input type="text" name="phone" required>
                        </div>
                       <div>
                            <label>email</label>
                            <input type="text" name="email" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submit">Add Teacher</button>
                         
                    </form>
            </div>
        </section>
</center>
    </main>

</body>
</html>