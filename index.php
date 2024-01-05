<?php
require_once 'FormInfoClass.php';
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- import -->
    <link href="bootstrap.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>

    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Registration</title>
</head>

<body>
    <!-- main html body -->
    <main class="form-signin w-100 m-auto">
        <div class="container-lg modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog">
            <div class="text-center">
                <h2 class="h2 rubik_font">REGISTRATION FORM</h2>
            </div>
            <div class="container mt-5">
                <form action="display.php" method="post">
                    <div class="form-group ">
                        <label for="userid">User ID *</label>
                        <input type="text" class="form-control" name="userid" type="number" value="<?php echo getLastId() + 1; ?>" required readonly>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-4">
                            <label for="firstName">First Name *</label>
                            <input type="text" class="form-control" name="firstName" required autofocus>
                        </div>
                        <div class="form-group col-4">
                            <label for="lastName">Last Name *</label>
                            <input type="text" class="form-control" name="lastName" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="middleInitial">Middle Initial</label>
                            <input type="text" class="form-control" name="middleInitial" maxlength="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age">Age *</label>
                        <input type="number" class="form-control" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="contactNo">Contact No. *</label>
                        <input type="tel" class="form-control" name="contactNo" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div style="margin-top: 20px">
                        <div>
                            <button type="submit" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary px-3 rubik_font" id="register-btn">Register</button>
                        </div>
                        <div>
                            <button type="button" class="w-100 mb-2 btn btn-lg rounded-3 btn-secondary px-3 rubik_font" id="login-btn" onclick="window.location.href='login.php'">Login</button>
                        </div>
                    </div>
                </form>
            </div>
    </main>

    </div>

    <!-- Import -->
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>