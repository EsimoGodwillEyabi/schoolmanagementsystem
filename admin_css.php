<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <style>
        .body-admindashboard {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .nav-title-admin {
            font-size: 24px;
            color: white;
            margin-left: 20px;
        }
        .nav-admindashboard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4593e2;
            color: white;
            padding: 0px 0px;
        }

        .nav-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav-links li {
            margin-right: 20px;
            display: flex;
            gap: 300px;
        }

        .nav-links a {
            text-decoration: none;
            
        }

        .nav-links a:hover {
            text-decoration: underline;
        }
        .logout-box {
            background-color: #194d7aff;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .main-admindashboard {
            display: flex;
            flex-direction: row;
        }
        .sidebar-admin {
            width: 200px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            align-items: center;
        }
        .sidebar-admin ul {
            list-style: none;
            padding: 20px;
        }
        .sidebar-admin li {
           padding-bottom: 25px;
        }
        .sidebar-admin a {
            color: white;
            text-decoration: none;
        }
        .sidebar-admin a:hover {
            text-decoration: underline;
        }
        .content-admin {
            display: flex;
            margin-left: 20px;
            padding: 20px;
            flex-direction: column;
        }
        .admin-dashboard-description {
            font-size: 18px;
            color: #333;
            margin-top: 3px;
        }
        </style>
    
</body>
</html>