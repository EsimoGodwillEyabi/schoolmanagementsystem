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
            <h2>Add Student</h2>

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

                    <form action="student_data_check.php" method="post" novalidate>
                        <!-- send usertype so server knows this is a student account -->
                        <input type="hidden" name="usertype" value="student">

                        <div>
                            <label>Username</label>
                            <input type="text" name="username" required>
                            <div class="input-hint">Choose a unique username for login</div>
                        </div>
                         <div>
                            <label>Phone</label>
                            <input type="tel" name="phone" placeholder="+234-000-000-0000" required>
                            <div class="input-hint">Enter at least 10 digits, can include +, - and spaces</div>
                        </div>
                         <div>
                            <label>Email</label>
                            <input type="email" name="email" required>
                            <div class="input-hint">Enter a valid email address (must be unique)</div>
                        </div>
                         <div>
                            <label>Password</label>
                            <input type="password" name="password" required>
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