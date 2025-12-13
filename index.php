<?php
   error_reporting(0);
   session_start();
   session_destroy();

   if("$_SESSION[message]"){
    $message = $_SESSION['message'];
       echo "<script type='text/javascript'> 
       alert('$message')</script>";
       
   }
// admissionform.php
// Simple admission form page. This file contains a presentational form and a minimal POST handler placeholder.
// Replace the POST handler with real storage/validation as needed.

// On POST we'll just collect sanitized input and show a success message (for demo).
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic sanitization
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $dob = trim(filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING));
    $program = trim(filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING));

    // Simple required checks
    if ($first_name === '' || $last_name === '' || $email === '' || $program === '') {
        $message = 'Please complete all required fields.';
    } else {
        // In a real app, save to DB and handle errors.
        $message = 'Application received. We will contact you at ' . htmlspecialchars($email);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>school management system</title>
</head>

<body>

    <style>
      

        .navigation1 {
            display: flex;
            gap: 18px; /* space between items */
                color: #000000;
                flex-direction: row;
                padding-left: 10px;
                align-items: center;
                margin-left: auto; /* push nav to the right of the header */
            }
            
    </style>

    <header class="site-header">
         <div class="div-site-logo">
                        <img src="assets/WHITESMLOGO.jpg" alt="School logo" id="site-logo">
                        <h1 class="hheader">WhiteSM System</h1>
         </div>
        
       
              <nav class="navigation1">
                 <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about_us.html">About Us</a></li>
                                        <li><a href="login.php" class="btn-success">login</a></li>
                                        <li><a href="admissionform.php" class="btn-success">Admission</a></li>
                 </ul>
              </nav>
       
    </header>
    <section class = "main-content1"> 
       <iframe id ="hero-video" 
    src="https://www.youtube.com/embed/3MFL26MSpbo" 
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen>
</iframe>
    <script src="index.js"></script>
    <section class ="content2">
                          <h4 class ="hcontent4">Our Services</h4>
                          <div class="content2-sub">
                                <div class="content2-sub1">
                                    <img src="assets\icons8-university-50.png" alt="Service 1">
                                    <h2>University management</h2>
                                    <p class= "pcontent2-sub">Access a wide range of courses and resources online. Designed to streamline administrative tasks, provide digital learning and secure data management.</p>
                                    <li><a href="about_us.html" class="box">Learn More</a></li>   
                                </div>

                                <div class="content2-sub2">
                                    <img src="assets\icons8-high-school-64.png" alt="Service 2">
                                    <h2>Secondary School</h2>
                                     <p class= "pcontent2-sub">A complete, integrated platform that handles report card generation, grade tracking, and all student-parent communication needs.</p>
                                     <li><a href="about_us.html" class="box">Learn More</a></li>
                                </div>

                                <div class="content2-sub3">
                                    <img src="assets\icons8-primary-school-48.png" alt="Service 3">
                                    <h2>Primary and Nursery</h2>
                                    <p class= "pcontent2-sub">  Gives administrators the ability to manage students smoothly and connect with parents promptly.</p>
                                    <li><a href="about_us.html" class="box">Learn More</a></li>
                                </div>
                                
                          </div>
    </section>
    <section class ="content3">
                          <h class ="hcontent3">Why is WhiteSM Different?</h>
                          <p class="pcontent3-sub">The mobile-friendly interface of the WhiteSM System lets teachers and administrators easily access and update information from any location. Teachers can specifically input student results and manage academic tasks directly using their smartphones.</p>
                          <div class="content3-sub">
                                <div class="content3-sub1">
                                    <img src="assets/app-icon.png" alt="Quality Education">
                                    <h2>Parents App</h2>
                                    <p class= "pcontent3-sub1">We provide top-notch education with experienced faculty and comprehensive curriculum to ensure student success.</p>
                                </div>
                                <div class="content3-sub2">
                                    <img src="assets/app-icon.png" alt="Student Support">
                                    <h2>Teachers App</h2>
                                     <p class= "pcontent3-sub1">Our dedicated support team is here to assist students with academic advising, counseling, and career services.</p>
                                </div>
                                <div class="content3-sub3">
                                    <img src="assets/app-icon-3.png" alt="Career Opportunities">
                                    <h2>Students App</h2>
                                    <p class= "pcontent3-sub1">We offer extensive career services including internships, job placements, and networking events to help students launch their careers.</p>
                                </div>
                          </div>
    </section>
    <section class="content4">  
                         <h class ="hcontent4">Our Work Process</h>
                         <p class="pcontent3-sub">WHITESM's mobile-friendly interface allows teachers and administrators to access and update information on the go. Teachers can input students' results and manage academic activities from their smartphones.</p>
                            <div class="content4-sub">
                                    <div class="content4-sub2">
                                                                <div class="content4-sub21">
                                                                        <img src="assets\icons8-gather-48.png" alt="Gathering Data" id="img-gathering-data">
                                                                        <div class="content4-sub21-text">
                                                                                      <h2>Gathering Data</h2>
                                                                                      <p class= "pcontent4-sub1">Our team designs user-friendly interfaces and robust systems to enhance the educational experience.</p>
                                                                        </div>
                                                                </div>
                                                                <div>
                                                                    <img src="assets/image.svg" alt="Gathering Data line" id="gathering-data-line">
                                                                </div>
                                                                <div class="content4-sub22">
                                                                        <div class="content4-sub22-text">
                                                                                      <h2>Customize your settings</h2>
                                                                                      <p class= "pcontent4-sub1">Select a report template and customize its appearance (color, logo, header, etc.).</p>
                                                                        </div>
                                                                        <img src="assets/icons8-settings-gear-50.png" alt="Customize Data" id="img-customize-data">
                                                                </div>
                                                                <div>
                                                                    <img src="assets/image (1).svg" alt="Gathering Data line" id="gathering-data-line">
                                                                </div>
                                                                <div class="content4-sub23">
                                                                        <img src="assets/icons8-settings-gear-50.png" alt="Enjoy" id="img-gathering-data">
                                                                        <div class="content4-sub23-text">
                                                                                      <h2>Enjoy!!</h2>
                                                                                      <p class= "pcontent4-sub1">WhiteSM Systems technology delivers easier administrative work, better communication, and smoother school operations.</p>
                                                                        </div>
                                                                </div>
                                    </div>
                                    <div class="content4-sub1">
                                         <img src="assets/PHOTO-2023-04-27-23-20-44-qaatgzj9m7o0hk7e4oy6l39nil92lbw3p2.jpg" alt="Planning" id="img-content4-sub1">
                                     </div>
                            
                            </div>
    </section>
    <div class ="review-section">
            <div class="review-container">
                        <img src="assets/icons8-institution-64.png" alt="Client 1" class="client-image">
                        <h2 class="client-name">4</h2>
                        <p class="client-review">"Institutions"</p>
            </div>
            <div class="review-container">
                        <img src="assets/icons8-teacher-64.png" alt="Client 1" class="client-image">
                        <h2 class="client-name">50</h2>
                        <p class="client-review">"Teachers"</p>
            </div>
            <div class="review-container">
                        <img src="assets\icons8-students-64.png" alt="Client 1" class="client-image">
                        <h2 class="client-name">60</h2>
                        <p class="client-review">"Students"</p>
            </div>
            <div class="review-container">
                        <img src="assets/icons8-parent-64.png" alt="Client 1" class="client-image">
                        <h2 class="client-name">50</h2>
                        <p class="client-review">"Parents"</p>
            </div>
    </div>
    <div class ="whattheysay-aboutus">
        <div class="slider" id="testimonial-slider">
            <div class="slides">
                <div class="slide">
                    <blockquote>
                        <p>"This system transformed how our institution manages records — simple and powerful."</p>
                        <cite>- Principal, St. Mary University</cite>
                    </blockquote>
                </div>
                <div class="slide">
                    <blockquote>
                        <p>"Teachers love the mobile features — grading on the go makes life easier."</p>
                        <cite>- Senior Lecturer</cite>
                    </blockquote>
                </div>
                <div class="slide">
                    <blockquote>
                        <p>"Parents appreciate the transparency. Communication has never been better."</p>
                        <cite>- Parent</cite>
                    </blockquote>
                </div>
            </div>
            <button class="prev" aria-label="Previous testimonial">‹</button>
            <button class="next" aria-label="Next testimonial">›</button>
            <div class="dots" role="tablist" aria-label="Testimonial pagination"></div>
        </div>
    </div>
    <div class="admission-page">
                  <style>
        /* Compact styles for single-screen visibility */
        .admission-page{display:flex;align-items:center;justify-content:center;padding:8px}
        .admission-card{width:100%;max-width:920px;background:#fff;border-radius:6px;box-shadow:0 8px 16px rgba(0,0,0,0.06);overflow:hidden}
        .admission-header{background:#2e7d32;color:#fff;padding:6px 12px}
        .admission-header h1{font-size:16px;margin:0 0 2px}
        .admission-body{padding:8px 12px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}
        .full{grid-column:1/-1}
        label{display:block;margin-bottom:2px;font-weight:500;font-size:12px}
        input[type="text"],input[type="email"],input[type="tel"],input[type="date"],select{
            width:100%;padding:4px 6px;border-radius:4px;border:1px solid #e6efe6;
            background:#fbfffb;font-size:12px;height:24px
        }
        textarea{
            width:100%;padding:4px 6px;border-radius:4px;border:1px solid #e6efe6;
            background:#fbfffb;font-size:12px;height:32px;resize:none
        }
        .actions{display:flex;justify-content:flex-end;gap:6px;margin-top:6px}
        .btn{padding:4px 10px;border-radius:4px;border:0;cursor:pointer;font-weight:500;font-size:12px}
        .btn-primary{background:#43a047;color:#fff}
        .note{font-size:11px;color:#556;margin:0}
        [role="status"]{padding:4px 6px;border-radius:4px;background:#f0fff0;margin-bottom:6px;font-size:12px}
        @media(max-width:720px){.grid{grid-template-columns:1fr}.admission-page{padding:6px}}
    </style>    

    <main class="admission-page">
        <section class="admission-card" aria-labelledby="admission-heading">
            <header class="admission-header">
                <h1 id="admission-heading">Admission Application</h1>
                <p class="note">Fields marked with * are required.</p>
            </header>
            <div class="admission-body">
                <?php if ($message !== ''): ?>
                    <div role="status" style="padding:10px;border-radius:8px;background:#f0fff0;margin-bottom:12px;">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form action="data_check.php" method="post" novalidate>
                    <div class="grid">
                        <div>
                            <label for="first_name">First name *</label>
                            <input id="first_name" name="first_name" type="text" required>
                        </div>
                        <div>
                            <label for="last_name">Last name *</label>
                            <input id="last_name" name="last_name" type="text" required>
                        </div>

                        <div>
                            <label for="email">Email *</label>
                            <input id="email" name="email" type="email" required>
                        </div>
                        <div>
                            <label for="phone">Phone</label>
                            <input id="phone" name="phone" type="tel" placeholder="+234 800 000 0000">
                        </div>

                        <div class="full">
                            <label for="dob">Date of birth</label>
                            <input id="dob" name="dob" type="date">
                        </div>

                        <div class="full">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" rows="2"></textarea>
                        </div>
                        <div class="full">
                            <label for="notes">Additional information</label>
                            <textarea id="notes" name="notes" rows="2" placeholder="Allergies, special requirements, prior qualifications"></textarea>
                        </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary" name="submit">Submit application</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    </div>
    <div class = "footer">
        <div class="footer-container1">
            <div class="footer-sub1">
                   <div class="div-footer-logo">
                        <img src="assets/WHITESMLOGO.jpg" alt="School logo" id="footer-logo">
                        <h1 class="hfooter">WhiteSM System</h1>
                    </div>
                        <p class="pfooter-sub1">WhiteSM System is a comprehensive school management system designed to streamline administrative tasks, enhance communication, and improve the overall educational experience for institutions of all sizes.</p>
                         <img src="assets/icons8-instagram-logo-94.png" alt="Instagram logo" id="instagram">
                          <img src="assets/icons8-facebook-logo-48.png" alt="Facebook logo" id="twitter">
                           <img src="assets/icons8-twitter-logo-48.png" alt="Twitter logo" id="facebook">
            </div>
            <div class="footer-sub2">
                        <h2>Quick Links</h2>
                        <ul class="ul-footer-sub2">
                                <li><a class="a-footer-sub2" href="#">Home</a></li>
                                <li><a class="a-footer-sub2" href="#">University</a></li>
                                <li><a class="a-footer-sub2" href="#">Secondary & Primary</a></li>
                                <li><a class="a-footer-sub2" href="#">About Us</a></li>
                        </ul>
            </div>
            <div class="footer-sub3">
                        <h2>Contact Us</h2>
                        <p class="pfooter-sub3">123 Education St., Knowledge City, Country</p>
                        <p class="pfooter-sub3">Phone: +123 456 7890</p>
                        <p class="pfooter-sub3">Email: info@schoolmanagementsystem.com</p>
            </div>
        </div>
        <div class="footer-container2">
                    <p class="pfooter-container2">© 2024 WHITESM. All rights reserved.</p>
        </div>
    </div>
</body>
</html>