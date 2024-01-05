<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bootstrap.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="jquery-3.7.1.js"></script>
    <title>User Information</title>
</head>

<body>
    <main class="form-signin w-100 m-auto">
        <div class="container-lg modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5">
            <div class="container mt-5">
                <?php

                require_once 'FormInfoClass.php';

                // from registration
                // Check if form data has been submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // assign sent values to php variables
                    $userid = htmlspecialchars($_POST["userid"]);
                    $firstName = htmlspecialchars($_POST["firstName"]);
                    $lastName = htmlspecialchars($_POST["lastName"]);
                    $middleInitial = htmlspecialchars($_POST["middleInitial"]);
                    $age = htmlspecialchars($_POST["age"]);
                    $contactNo = htmlspecialchars($_POST["contactNo"]);
                    $email = htmlspecialchars($_POST["email"]);
                    $address = htmlspecialchars($_POST["address"]);
                    $username = htmlspecialchars($_POST["username"]);
                    $password = htmlspecialchars($_POST["password"]);

                    //
                    $hasMiddleInitial = true;
                    if ($middleInitial === null || empty($middleInitial)) {
                        $hasMiddleInitial = false;
                    }

                    // instantiate FormInfoClass class and assign class fields
                    $formData = new FormInfoClass();
                    $formData->setUserId($userid);
                    $formData->setFirstName($firstName);
                    $formData->setLastName($lastName);
                    if ($hasMiddleInitial) {
                        $formData->setMiddleInitial($middleInitial);
                    }
                    $formData->setAge($age);
                    $formData->setContactNo($contactNo);
                    $formData->setEmail($email);
                    $formData->setAddress($contactNo);
                    $formData->setUsername($username);
                    $formData->setPassword($password);

                    //
                    $registrationHeading = "REGISTRATION SUCCESSFUL!";
                    if (isUserIdExisting($formData->getUserId()) || isUsernameExisting($formData->getUsername())) {
                        $registrationHeading = "REGISTRATION FAILED!";
                    }
                    //
                    echo ("
                    <div class=\"text-center\">
                        <h2 class=\"h2 rubik_font\" id=\"registrationHeading\">" . $registrationHeading . "</h2>
                    </div>"
                    );
                    echo "<h3 class=\"h3\">Your Entered Information:</h3>";
                    // Display the user information
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">User ID: </span><span class=\"form-control\">" . $formData->getUserId() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">First Name:: </span><span class=\"form-control\">" . $formData->getFirstName() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Last Name: </span><span class=\"form-control\">" . $formData->getLastName() . "</span></div>";
                    echo (($formData->getMiddleInitial() === null || empty($formData->getMiddleInitial())) ? '' : "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Middle Initial: </span><span class=\"form-control\">" . $formData->getMiddleInitial() . "</span></div>");
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Age: </span><span class=\"form-control\">" . $formData->getAge() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Contact No.: </span><span class=\"form-control\">" . $formData->getContactNo() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Email: </span><span class=\"form-control\">" . $formData->getEmail() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Address: </span><span class=\"form-control\">" . $formData->getAddress() . "</span></div>";
                    echo "<div class=\"input-group mt-1\"><span class=\"input-group-text\">Username: </span><span class=\"form-control\">" . $formData->getUsername() . "</span></div>";
                    echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Password: </span><input class=\"form-control\" type=password readonly value=" . $formData->getPassword() . "></div>";

                    // ensure username is unique
                    if (isUserIdExisting($formData->getUserId()) || isUsernameExisting($formData->getUsername())) {

                        echo "<div class=\"alert alert-danger\">";
                        echo "<p class=\"list-group-item list-group-item-danger\"><strong>Cannot register! Please try again!</strong></p>";
                        if (isUserIdExisting($formData->getUserId())) {
                            echo "<a class=\"list-group-item list-group-item-danger\">&#x2022; " . "UserID `" . $formData->getUserId() . "` is already existing!" . "</a>";
                        }
                        if (isUsernameExisting($formData->getUsername())) {
                            echo "<a class=\"list-group-item list-group-item-danger\">&#x2022; " . "Username `" . $formData->getUsername() . "` is already existing!" . "</a>";
                        }
                        echo "</div>";
                    } else {
                        // insert value to MySQL Database table
                        if ($hasMiddleInitial) {
                            registerUser(
                                $formData->getUserId(),
                                $formData->getUsername(),
                                $formData->getPassword(),
                                $formData->getFirstName(),
                                $formData->getLastName(),
                                $formData->getMiddleInitial(),
                                $formData->getAge(),
                                $formData->getContactNo(),
                                $formData->getEmail(),
                                $formData->getAddress()
                            );
                        } else {
                            registerUserNoMI(
                                $formData->getUserId(),
                                $formData->getUsername(),
                                $formData->getPassword(),
                                $formData->getFirstName(),
                                $formData->getLastName(),
                                $formData->getAge(),
                                $formData->getContactNo(),
                                $formData->getEmail(),
                                $formData->getAddress()
                            );
                        }
                    }
                }

                // from login
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $username = null;
                    $password = null;
                    // validate if isset
                    if (isset($_GET["username"]) && isset($_GET["password"])) {
                        $username = $_GET["username"];
                        $password = $_GET["password"];
                    }
                    if ($username == null || $password == null) {
                        die("<div class=\"alert alert-danger\"><h3 class=class=\"h3 list-group-item list-group-item-danger\">No command to do.</h3></div> <div style=\"margin-top: 20px\">
                        <div>
                            <button type=\"button\" class=\"w-100 mb-2 btn btn-lg rounded-3 btn-primary px-3 rubik_font\" id=\"register-btn\" onclick=\"window.location.href='index.php'\">Register</button>
                        </div>
                        <div>
                            <button type=\"button\" class=\"w-100 mb-2 btn btn-lg rounded-3 btn-secondary px-3 rubik_font\" id=\"login-btn\" onclick=\"window.location.href='login.php'\">Login</button>
                        </div>
                        </div>");
                    }
                    // check if user is found
                    $user = getUserDetails($username, $password);
                    if ($user == null) {
                        // if there is no user found with matching data
                        echo ("
                        
                        <div class=\"text-center\">
                            <h2 class=\"h2 rubik_font\" id=\"registrationHeading\">LOGIN FAILED</h2>
                        </div>"
                        );
                        echo "<div class=\"alert alert-danger\">";
                        echo "<a class=\"h3 list-group-item list-group-item-danger\">No account with matching data found.<br>Please try again!</a>";
                        echo "</div>";
                    } else {
                        // if there is a user found with matching data
                        echo ("
                        <div class=\"text-center\">
                            <h2 class=\"h2 rubik_font\">LOGIN SUCCESSFUL!</h2>
                        </div>"
                        );
                        echo "<h3 class=\"h3\">Your Information:</h3>";
                        // Display the user information
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">User ID: </span><span class=\"form-control\">" . $user->getUserId() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">First Name:: </span><span class=\"form-control\">" . $user->getFirstName() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Last Name: </span><span class=\"form-control\">" . $user->getLastName() . "</span></div>";
                        echo (($user->getMiddleInitial() === null || empty($user->getMiddleInitial())) ? '' : "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Middle Initial: </span><span class=\"form-control\">" . $user->getMiddleInitial() . "</span></div>");
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Age: </span><span class=\"form-control\">" . $user->getAge() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Contact No.: </span><span class=\"form-control\">" . $user->getContactNo() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Email: </span><span class=\"form-control\">" . $user->getEmail() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Address: </span><span class=\"form-control\">" . $user->getAddress() . "</span></div>";
                        echo "<div class=\"input-group mt-1\"><span class=\"input-group-text\">Username: </span><span class=\"form-control\">" . $user->getUsername() . "</span></div>";
                        echo "<div class=\"input-group mb-0\"><span class=\"input-group-text\">Password: </span><input class=\"form-control\" type=password readonly value=" . $user->getPassword() . "></div>";
                    }
                }

                ?>
                <div style="margin-top: 20px">
                    <div>
                        <button type="button" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary px-3 rubik_font" id=" register-btn" onclick="window.location.href='index.php'">Register</button>
                    </div>
                    <div>
                        <button type="button" class="w-100 mb-2 btn btn-lg rounded-3 btn-secondary px-3 rubik_font" id=" login-btn" onclick="window.location.href='login.php'">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Import your scripts and styles here -->
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>