<?php
class general
{
    public $connect;
    public $user_id;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["admin_id"])) {
            $this->user_id = $_SESSION["admin_id"];
        } else {
            header("location:../index.php");
        }
    }

    protected function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function selectPensioner()
    {
        $sql = $this->connect->query("SELECT * FROM `pensioner`");
        return $sql;
    }

    public function resetDataToDash($data)
    {
        $data = ($data) ? number_format($data) : "-";
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
final class dashboard extends general
{
    public function setPensionRate()
    {
        $sql = $this->connect->query("SELECT * FROM `pension_rate`");

        if ($sql->num_rows <= 0) {
            $this->connect->query("INSERT INTO `pension_rate` (employer_contribution,employee_contribution) VALUES (0,0)");
        }
    }
}
final class manage_pensioneer extends general
{
    public $pensioner_id;
    public $pensioner_name;
    public $pensioner_email;


    public function collectInputs()
    {
        $this->pensioner_id = $this->validateInput($_POST["pensioner_id"]);
        $this->pensioner_name = $this->validateInput($_POST["pensioner_name"]);
        $this->pensioner_email = $this->validateInput($_POST["pensioner_email"]);
    }

    public function checkIfIDOrEmailExist()
    {
        $sql = $this->connect->query("SELECT * FROM `pensioner` WHERE pensioner_id = '$this->pensioner_id' OR email = '$this->pensioner_email'");
        if ($sql->num_rows > 0) {
            $this->errorMessage("Pensioner ID Or Email Exist!");
            return true;
        } else {
            return false;
        }
    }

    public function insertIntoDB()
    {
        $sql = $this->connect->query("INSERT INTO `pensioner` (pensioner_id,fullname,email,password) VALUES ('$this->pensioner_id','$this->pensioner_name','$this->pensioner_email','12345')");

        if ($sql) {
            $this->displaySuccessMessage('./manage_pensioneer.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function modifyStatus($status)
    {
        switch ($status) {
            case '1':
                $status_badge = "<span class='badge bg-success'>Active</span>";
                break;

            case '0':
                $status_badge = "<span class='badge bg-secondary'>Inactive</span>";
                break;
        }
        return $status_badge;
    }

    public function updatePensioner()
    {
        $pensioner_id = $this->validateInput($_POST["pensioner_id"]);
        $pensioner_name = $this->validateInput($_POST["pensioner_name"]);
        $pensioner_email = $this->validateInput($_POST["pensioner_email"]);
        $status = $this->validateInput($_POST["status"]);

        $sql = $this->connect->query("UPDATE `pensioner` SET fullname='$pensioner_name',email='$pensioner_email',status=$status WHERE pensioner_id ='$pensioner_id' ");

        if ($sql) {
            $this->displaySuccessMessage('./manage_pensioneer.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function deletePensioner()
    {
        $pensioner_id = $this->validateInput($_POST["pensioner_id"]);

        $sql = $this->connect->query("DELETE FROM `pensioner` WHERE pensioner_id = '$pensioner_id'");

        if ($sql) {
            $this->displaySuccessMessage('./manage_pensioneer.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

final class update_payment extends general
{
    public $pensioner_id;
    public $salary;
    public $allowance;
    public $years_of_service;


    public function collectInputs()
    {
        $this->pensioner_id = $this->validateInput($_POST["pensioner_id"]);
        $this->salary = $this->validateInput($_POST["salary"]);
        $this->allowance = $this->validateInput($_POST["allowance"]);
        $this->years_of_service = $this->validateInput($_POST["years_of_service"]);
    }

    public function insertIntoDB()
    {
        $sql = $this->connect->query("UPDATE `pensioner` SET salary = $this->salary, allowance =$this->allowance, years_of_service = '$this->years_of_service' WHERE pensioner_id = '$this->pensioner_id'");

        if ($sql) {
            $this->displaySuccessMessage('./update_payment.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function resetPensionerInfo()
    {
        $pensioner_id = $this->validateInput($_POST["pensioner_id"]);

        $sql = $this->connect->query("UPDATE `pensioner` SET salary = NULL, allowance =NULL, years_of_service = NULL WHERE pensioner_id = '$pensioner_id'");

        if ($sql) {
            $this->displaySuccessMessage('./update_payment.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

final class notification extends general
{
    public $title;
    public $message;
    public $send_to;

    public function collectInputs()
    {
        $this->title = $this->validateInput($_POST["title"]);
        $this->message = $this->validateInput($_POST["message"]);
        $this->send_to = $this->validateInput($_POST["send_to"]);
    }

    public function insertIntoDB()
    {
        $sql = $this->connect->query("INSERT INTO `notification` (title,message,send_to) VALUES ('$this->title','$this->message','$this->send_to')");

        if ($sql) {
            $this->displaySuccessMessage('./notification.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function deleteNotification()
    {
        $notification_id = $this->validateInput($_POST["notification_id"]);

        $sql = $this->connect->query("DELETE FROM `notification` WHERE notification_id = '$notification_id'");

        if ($sql) {
            $this->displaySuccessMessage('./notification.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function selectNotificationsForAll()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` WHERE send_to = '0'");
        return $sql;
    }

    public function selectNotificationsForPensioner()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` INNER JOIN `pensioner` ON notification.send_to = pensioner.pensioner_id");
        return $sql;
    }

    public function fetchPassesPensionerName($pensioner_id)
    {
        $sql = $this->connect->query("SELECT * FROM `pensioner` WHERE pensioner_id = '$pensioner_id'");
        $result = $sql->fetch_assoc();
        return $result["fullname"];
    }
}

final class settings extends general
{
    public $employer_contribution;
    public $employee_contribution;

    public function collectInputs()
    {
        $this->employee_contribution = $this->validateInput($_POST["employee_contribution"]);
        $this->employer_contribution = $this->validateInput($_POST["employer_contribution"]);
    }

    public function insertIntoDB()
    {
        $sql = $this->connect->query("UPDATE `pension_rate` SET employer_contribution = $this->employer_contribution,employee_contribution = $this->employee_contribution");

        if ($sql) {
            $this->displaySuccessMessage('./settings.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function fetchemployerContribution()
    {
        $sql = $this->connect->query("SELECT employer_contribution FROM `pension_rate`");
        $result = $sql->fetch_assoc();
        return $result["employer_contribution"] ?? 0;
    }

    public function fetchemployeeContribution()
    {
        $sql = $this->connect->query("SELECT employee_contribution FROM `pension_rate`");
        $result = $sql->fetch_assoc();
        return $result["employee_contribution"] ?? 0;
    }

    public function resetForEmployee()
    {
        $sql = $this->connect->query("UPDATE `pension_rate` SET employee_contribution = 0");

        if ($sql) {
            $this->displaySuccessMessage('./settings.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function resetForEmployer()
    {
        $sql = $this->connect->query("UPDATE `pension_rate` SET employer_contribution = 0");

        if ($sql) {
            $this->displaySuccessMessage('./settings.php');
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}
