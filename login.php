<?php
require_once 'FormInfoClass.php';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- import -->
    <link href="bootstrap.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>

    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Login</title>
</head>

<body>
    <!-- main html body -->
    <main class="form-signin w-100 m-auto">
        <div class="container-lg modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5">
            <div class="text-center">
                <h2 class="h2 rubik_font">LOGIN</h2>
            </div>
            <div class="container mt-5">
                <form action="display.php" method="get">
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" class="form-control" name="username" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div style="margin-top: 20px">
                        <div>
                            <button type="submit" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary px-3 rubik_font" id="login-btn">Login</button>
                        </div>
                        <div>
                            <button type="button" class="w-100 mb-2 btn btn-lg rounded-3 btn-secondary px-3 rubik_font" id="register-btn" onclick="window.location.href='index.php'">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Import -->
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>