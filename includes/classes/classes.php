<?php
class general
{
    public $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    protected function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function displaySuccessMessage($href)
    {
        echo "
            <script>
                window.alert('Success!');
                window.location.href='" . $href . "';
            </script>
        ";
        die();
    }


    public function errorMessage($message)
    {
        echo '
            <script>
                window.alert("' . $message . '");
            </script>
        ';
    }
}


class login extends general
{
    public $pension_id_email;
    public $password;
    public $login_err;
    public $whoIsPassed;

    public function collectInputs()
    {
        $this->pension_id_email = $this->validateInput($_POST["pension_id"]);
        $this->password = $this->validateInput($_POST["password"]);
    }

    public function authorizeFromAdmin()
    {
        $select_from_admin = $this->connect->query("SELECT * FROM `admin` WHERE email = '$this->pension_id_email' AND password = '$this->password'");
        $result = $select_from_admin->fetch_assoc() ?? null;

        if ($select_from_admin->num_rows <= 0) {
            $this->login_err = "Invalid Credentials!";
        } else {
            $_SESSION["admin_id"] = $result["admin_id"];
            $this->whoIsPassed = "admin";
            $this->redirection();
            return true;
        }
        return false;
    }

    public function authorizeFromUser()
    {
        $select_from_user = $this->connect->query("SELECT * FROM `pensioner` WHERE pensioner_id = '$this->pension_id_email' AND password = '$this->password'");
        $result = $select_from_user->fetch_assoc() ?? null;

        if ($select_from_user->num_rows <= 0) {
            $this->login_err = "Invalid Credentials!";
        } else {
            $this->login_err = null;
            $_SESSION["pensioner_id"] = $result["pensioner_id"];
            $this->whoIsPassed = "pensioner";
            $this->redirection();
        }
    }

    public function redirection()
    {
        switch ($this->whoIsPassed) {
            case 'admin':
                header("location:./Admin/dashboard.php");
                break;

            case 'pensioner':
                header("location:./User/dashboard.php");
                break;
        }
    }
}


// class register extends general
// {
//     public $fullname;
//     public $email;
//     public $password;


//     public function collectInputs()
//     {
//         $this->fullname = $this->validateInput($_POST["fullname"]);
//         $this->pension_id_email = $this->validateInput($_POST["email"]);
//         $this->password = $this->validateInput($_POST["password"]);
//     }

//     public function checkIfEmailExist()
//     {
//         $sql = $this->connect->query("SELECT * FROM `user` WHERE email = '$this->pension_id_email'");
//         if ($sql->num_rows > 0) {
//             $this->errorMessage("Email Exist!");
//             return true;
//         } else {
//             return false;
//         }
//     }

//     public function insertIntoDB()
//     {
//         $sql = $this->connect->query("INSERT INTO `user` (fullname,email,password) VALUES ('$this->fullname','$this->pension_id_email','$this->password')");

//         if ($sql) {
//             $this->displaySuccessMessage('./index.php');
//         }
//     }
// }
