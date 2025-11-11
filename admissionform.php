<?php
session_start();

// Check for messages from data_check.php
$success_message = '';
$error_message = '';

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Compact styles for single-screen visibility */
        .admission-page{display:flex;align-items:center;justify-content:center;padding:8px}
        .admission-card{width:50%;max-width:920px;background:#fff;border-radius:6px;box-shadow:0 8px 16px rgba(0,0,0,0.06);overflow:hidden}
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
        .message{padding:8px 12px;border-radius:4px;margin-bottom:12px;font-size:13px}
        .message-success{background:#e8f5e9;color:#2e7d32;border:1px solid #c8e6c9}
        .message-error{background:#ffebee;color:#c62828;border:1px solid #ffcdd2}
        @media(max-width:720px){.grid{grid-template-columns:1fr}.admission-page{padding:6px}}
    </style>
</head>
<body>
    <main class="admission-page">
        <section class="admission-card" aria-labelledby="admission-heading">
            <header class="admission-header">
                <h1 id="admission-heading">Admission Application</h1>
                <p class="note">Fields marked with * are required.</p>
            </header>
            <div class="admission-body">
                <?php if ($success_message): ?>
                    <div role="status" class="message message-success">
                        <?= htmlspecialchars($success_message) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div role="alert" class="message message-error">
                        <?= htmlspecialchars($error_message) ?>
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

                        <div>
                            <label for="dob">Date of birth</label>
                            <input id="dob" name="dob" type="date">
                        </div>
                        <div>
                            <label for="program">Program *</label>
                            <select id="program" name="program" required>
                                <option value="">Select program</option>
                                <option>Undergraduate - Computer Science</option>
                                <option>Undergraduate - Business Admin</option>
                                <option>Secondary - Form 1</option>
                                <option>Primary - Grade 1</option>
                            </select>
                        </div>

                        <div class="full">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" rows="2"></textarea>
                        </div>

                        <div class="full">
                            <label for="notes">Additional information</label>
                            <textarea id="notes" name="notes" rows="2" placeholder="Allergies, special requirements, prior qualifications"></textarea>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="reset" class="btn">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit application</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
