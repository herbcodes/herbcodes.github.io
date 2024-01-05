<?php
// declare class
class FormInfoClass
{
    // class fields
    private $userId;
    private $firstName;
    private $lastName;
    private $middleInitial;
    private $age;
    private $contactNo;
    private $email;
    private $address;
    private $username;
    private $password;

    // getter methods
    public function getUserId()
    {
        return $this->userId;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getMiddleInitial()
    {
        return $this->middleInitial;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getContactNo()
    {
        return $this->contactNo;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    // setter methods
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function setMiddleInitial($middleInitial)
    {
        $this->middleInitial = $middleInitial;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function setContactNo($contactNo)
    {
        $this->contactNo = $contactNo;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

// function that returns mysql connection
function connectToMySQL()
{
    // database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud_reg_lab";

    // mysqli connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function registerUser($userid, $username, $password, $firstName, $lastName, $middleInitial, $age, $contactNo, $email, $address)
{
    // establish MySQL connection
    $conn = connectToMySQL();

    // perform query
    $insertQuery = "INSERT INTO `users` (`userid`, `firstname`, `lastname`, `middleinitial`, `age`, `contactno`, `email`, `address`, `username`, `password`) VALUES ('$userid', '$firstName', '$lastName', '$middleInitial', '$age', '$contactNo', '$email', '$address', '$username', '$password');";
    $result = mysqli_query($conn, $insertQuery);

    // close database connection
    mysqli_close($conn);
}

// no middle initial
function registerUserNoMI($userid, $username, $password, $firstName, $lastName, $age, $contactNo, $email, $address)
{
    // establish MySQL connection
    $conn = connectToMySQL();

    // perform query
    $insertQuery = "INSERT INTO `users` (`userid`, `firstname`, `lastname`, `age`, `contactno`, `email`, `address`, `username`, `password`) VALUES ('$userid', '$firstName', '$lastName', '$age', '$contactNo', '$email', '$address', '$username', '$password');";
    $result = mysqli_query($conn, $insertQuery);

    // close database connection
    mysqli_close($conn);
}

function isUserIdExisting($userid) {
    // establish MySQL connection
    $conn = connectToMySQL();

    //
    $query = "SELECT * FROM users WHERE userid='$userid';";
    $result = mysqli_query($conn, $query);

    // die if error
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // fetch row with matching data
    $row = mysqli_fetch_assoc($result);

    // check if a match is found
    if (!$row) {
        // if nothing found, return null
        return false;
    }

    return true;
}

function isUsernameExisting($username) {
    // establish MySQL connection
    $conn = connectToMySQL();

    //
    $query = "SELECT * FROM users WHERE username='$username';";
    $result = mysqli_query($conn, $query);

    // die if error
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // fetch row with matching data
    $row = mysqli_fetch_assoc($result);

    // check if a match is found
    if (!$row) {
        // if nothing found, return null
        return false;
    }

    return true;
}

function getUserDetails($username, $password)
{
    // establish MySQL connection
    $conn = connectToMySQL();

    //
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1;";
    $result = mysqli_query($conn, $query);

    // die if error
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // fetch row with matching data
    $row = mysqli_fetch_assoc($result);

    // check if a match is found
    if (!$row) {
        // if nothing found, return null
        return null;
    }

    // instantiate object and assign values
    $userInfo = new FormInfoClass();
    $userInfo->setUserId($row['userid']);
    $userInfo->setFirstName($row['firstname']);
    $userInfo->setLastName($row['lastname']);
    $userInfo->setMiddleInitial($row['middleinitial']);
    $userInfo->setAge($row['age']);
    $userInfo->setContactNo($row['contactno']);
    $userInfo->setEmail($row['email']);
    $userInfo->setAddress($row['address']);
    $userInfo->setUsername($row['username']);
    $userInfo->setPassword($row['password']);

    // close database connection
    mysqli_close($conn);

    // return the object
    return $userInfo;
}

// function to get the max value of the userid INT column in the user table of database
function getLastId()
{
    // establish MySQL connection
    $conn = connectToMySQL();

    $query = "SELECT COALESCE(MAX(userid), 1000) AS 'maxuserid' FROM users;";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the query error (you might want to improve error handling)
        die("Query failed: " . mysqli_error($conn));
    }

    // fetch row from result
    $row = mysqli_fetch_assoc($result);
    $value = (int)$row['maxuserid'];

    // close database connection
    mysqli_close($conn);

    return $value;
}
//
