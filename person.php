<?php 
class Formula {
    public int $userID;
    public string $username;
    public string $password;
    public string $lastName;
    public string $firstName;
    public string $middleName;
    public string $contact;
    public int $age;
    public string $address;

    public function getFullName() {
        if ($this->middleName == null || $this->middleName == "") {
            return $this->firstName . " " . $this->lastName;
        }

        return $this->firstName . " " . $this->middleName[0] . " " . $this->lastName;
    }
}
?>