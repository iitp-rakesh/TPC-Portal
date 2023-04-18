<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        #tab-layout {
            margin: 50px auto;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .tab {
            display: none;
            padding: 20px;
        }

        .tab.active {
            display: block;
        }

        .tab-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .tab-button.active {
            background-color: #444;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button,
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button,
        input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>Training and Placement Portal</h1>
    </div>

    <div id="tab-layout">
        <div class="tab-buttons">
            <button class="tab-button active" onclick="openTab(event, 'student-tab')">Student</button>
            <button class="tab-button" onclick="openTab(event, 'company-tab')">Company</button>
            <button class="tab-button" onclick="openTab(event, 'alumni-tab')">Alumni</button>
            <button class="tab-button" onclick="openTab(event, 'admin-tab')">Admin</button>
        </div>

        <div id="student-tab" class="tab active">
            <h2>Student Login</h2>
            <form action="studentlogin.php" method="post">
                <label for="student-username">Email</label>
                <input type="text" id="student-username" name="student-username" placeholder="Enter your email">
                <label for="student-password">Password</label>
                <input type="password" id="student-password" name="student-password" placeholder="Enter your password">
                <input type="submit" value="Log in">
            </form>
            <br>
            <a href="signup.php"><button>Create Student Account</button></a>
        </div>


        <div id="company-tab" class="tab">
            <h2>Company Login</h2>
            <form action="companylogin.php" method="post">
                <label for="company-usernam">Email</label>
                <input type="text" id="company-username" name="company-username" placeholder="Enter your email">
                <label for="company-password">Password</label>
                <input type="password" id="company-password" name="company-password" placeholder="Enter your password">
                <input type="submit" value="Log in">
            </form>
            <br>
            <a href="companysignup.php"><button>Create Company Account</button></a>
        </div>
        <div id="alumni-tab" class="tab">
            <h2>Alumni Login</h2>
            <form action="alumnilogin.php" method="post">
                <label for="alumni-username">Email</label>
                <input type="text" id="alumni-username" name="alumni-username" placeholder="Enter your email">
                <label for="alumni-password">Password</label>
                <input type="password" id="alumni-password" name="alumni-password" placeholder="Enter your password">
                <input type="submit" value="Log in">
            </form>
            <br>
            <a href="alumnisignup.php"><button>Create Alumni Account</button></a>
        </div>

        <div id="admin-tab" class="tab">
            <h2>Admin Login</h2>
            Default Username: admin , password : Admin@123<br><br>
            <form action="adminlogin.php" method="post">
                <label for="admin-username">Username</label>
                <input type="text" id="admin-username" name="admin-username" placeholder="admin">
                <label for="admin-password">Password</label>
                <input type="password" id="admin-password" name="admin-password" placeholder="Admin@123">
                <input type="submit" value="Log in">
            </form>
            <br>
        </div>
    </div>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>