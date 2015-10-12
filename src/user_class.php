<?php


class User
{
    static private $conn;
    private $id;
    private $name;
    private $email;


    public static function setConnection(mysqli $bridge)
    {
        self::$conn = $bridge;
    }


    public static function register($name, $email, $password, $password2)
    {
        if ($password != $password2) {
            return false;
        }
        if (($name || $email || $password || $password2) == null) {
            return false;
        }
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO Users (name, email, password) VALUES ('$name', '$email', '$hashedpassword');";
        $re = self::$conn->query($sql);

        if ($re == true) {
            $newId = self::$conn->insert_id;
            $newUser = new User($newId, $name, $email);
            return $newUser;

        }
        echo self::$conn->error;

        return false;
    }

    static public function logIn($name, $password)
    {
        $sql = "SELECT * FROM Users WHERE name = '$name'";
        $re = self::$conn->query($sql);


        if ($re->num_rows == 1) {

            if ($re == true) {
                if ($re->num_rows == 1) {
                    $row = $re->fetch_assoc();
                    if (password_verify($password, $row["password"])) {
                        $loggedUser = new User($row['id'], $row["name"], $row["email"]);
                        return $loggedUser;
                    }
                    return false;
                }
            }
        }
    }


    public
    function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

    }

    public function getName(){
    echo $this->name;
}

}