

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

<style>
    .nav-title-admin a {
        color: white;
        text-decoration: none;
    }
    #teacher_image {
        border-radius: 50%;
    }
</style>
</head>
<body>

<header>
        <nav class="nav-admindashboard">
            <div>
                <h1 class="nav-title-admin"><a href="teacherhome.php">Teacher Dashboard</a></h1>
            </div>
            <div class="nav-links">
                <ul>
                
                    <li><a  class="logout-box" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main-admindashboard">

        <aside class="sidebar-admin">
            <div class="teacher_profile_image">
                  <a href="teacherprofile.php"><img src="teacher_images\1762345656_IMG_1298.JPG" alt="Teacher Image" width="80" height="80"  id="teacher_image"></a>
              
                </div>  
            <ul>
                <li><a href="mycourses.php">My Courses</a></li>
                <li><a href="mystudents.php">My Students</a></li>
                <li><a href="add_marks.php">Add Marks</a></li>
                <li><a href="teacherprofile.php">Profile Settings</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </aside>

    
</body>
</html>