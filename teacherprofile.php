
<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] !=="teacher") {
    header("Location: login.php");
}

$host="localhost";
$user="root";
$password="";
$db="schoolmanagementsystem";

$conn=mysqli_connect($host,$user,$password,$db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch current teacher data
$username = $_SESSION['username'];
$sql = "SELECT * FROM teaccher WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();
$stmt->close();

if (!$teacher) {
    die("Teacher not found.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    
    $update_sql = "UPDATE teaccher SET fullname=?, username=?, phone=? WHERE username=?";
    $stmt = $conn->prepare($update_sql);
    if ($stmt) {
        $stmt->bind_param('ssss', $name, $new_username, $details, $username);
        if ($stmt->execute()) {
            $_SESSION['username'] = $new_username; // Update session if username changed
            echo "<script>alert('Profile updated successfully.');</script>";
            // Refresh data
            $username = $new_username;
            $sql = "SELECT * FROM teaccher WHERE username=?";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param('s', $username);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $teacher = $result->fetch_assoc();
            $stmt2->close();
        } else {
            echo "<script>alert('Update failed.');</script>";
        }
        $stmt->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <?php

    include 'teacher_css.php'

    ?>
     <style>
    .teacher_profile_info {
        display: flex;
        }
     .teacher_profile_details {
        margin-bottom: 20px;
        display: flex;
        flex-direction: row;
        gap: 50px;
        }
    .teacher_profile_settings {
        display: flex;
        flex-direction: row;
        margin-left: 20px;
        color: white;
        background-color: #0476f8ff;
        border-radius: 8px;
        text-align: center;
        width: 750px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .teacher_profile_settings_item {
        margin-left: 120px;
        }
    .teacher_profile_details_item a {
        text-decoration: none;
        color: white;
        display: flex;
        flex-direction: row;
        }
    
    
    </style> 

</head>
<body class="body-admindashboard">
    
        <?php

    include 'teacher_sidebar.php'
    
        ?>

        <center>
            <section class="content-admin">
                <h2>Profile</h2>
            </section>   
            <section class="teacher_profile_info">   
                <div class="teacher_profile_settings">
                    <form method="POST" action="">
                        <div class="teacher_profile_settings_item">
                            <h3> fullname </h3>
                            <input type="text" name="fullname" value="<?php echo htmlspecialchars($teacher['fullname']); ?>" required>
                        </div> 
                        <div class="teacher_profile_settings_item">
                            <h3> Username </h3>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($teacher['username']); ?>" required>
                        </div> 
                        <div class="teacher_profile_settings_item">
                            <h3> Details (Phone) </h3>
                            <input type="text" name="details" value="<?php echo htmlspecialchars($teacher['phone']); ?>" required>
                        </div>
                        <div class="teacher_profile_settings_item">
                            <button type="submit" name="update_profile">Update Profile</button>
                        </div>
                    </form>
                </div>
            </section>
        </center>

</body>
</html>