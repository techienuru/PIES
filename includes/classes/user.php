<?php
class general
{
    public $connect;
    public $user_id;

    public $pensioner_id;
    public $fullname;
    public $email;
    public $status;
    public $password;
    public $salary;
    public $allowance;
    public $total_earnings;
    public $years_of_service;

    public $noOfQuestions;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["pensioner_id"])) {
            $this->user_id = $_SESSION["pensioner_id"];
            $this->collectUserDetails();
        } else {
            header("location:../index.php");
            die();
        }
    }

    public function collectUserDetails()
    {
        $sql = $this->connect->query("SELECT * FROM `pensioner` WHERE pensioner_id = '$this->user_id'");
        $result = $sql->fetch_assoc();

        $this->pensioner_id = $result["pensioner_id"];
        $this->fullname = $result["fullname"];
        $this->email = $result["email"];
        $this->status = ($result["status"] == 1) ? "Active" : "Inactive";
        $this->password = $result["password"];
        $this->salary = number_format($result["salary"]);
        $this->allowance = number_format($result["allowance"]);
        $this->total_earnings = ($this->convertStringToInt($this->salary) + $this->convertStringToInt($this->allowance));
        $this->total_earnings = number_format($this->total_earnings);
        $this->years_of_service = $result["years_of_service"];
    }

    public function calculatePensionSavings()
    {
        $sql = $this->connect->query("SELECT * FROM `pension_rate`");
        $result = $sql->fetch_assoc();
        $employer_contribution = $result["employer_contribution"] ?? 0;
        $employee_contribution = $result["employee_contribution"] ?? 0;

        $employer_contribution_from_salary = ($this->convertStringToInt($this->total_earnings) * $employer_contribution) / 100;
        $employee_contribution_from_salary = ($this->convertStringToInt($this->total_earnings) * $employee_contribution) / 100;

        $pension_savings = ($employer_contribution_from_salary + $employee_contribution_from_salary) * 12 * $this->years_of_service;
        return number_format($pension_savings);
    }

    public function calculateYearlyPaymenet($pension_savings)
    {
        $yearly_payment = $this->convertStringToInt($pension_savings) / 10;
        return number_format($yearly_payment);
    }

    public function convertStringToInt($string)
    {
        // Remove commas from the string
        $numberWithoutCommas = str_replace(',', '', $string);

        // Convert the result to an integer
        return (int)$numberWithoutCommas;
    }

    public function selectNotificationsForAll()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` WHERE send_to = '0'");
        return $sql;
    }

    public function selectNotificationsForPensioner()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` INNER JOIN `pensioner` ON notification.send_to = pensioner.pensioner_id WHERE notification.send_to = '$this->user_id'");
        return $sql;
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

final class dashboard extends general
{
    public function selectNotificationsForAllWithLimit()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` WHERE send_to = '0' ORDER BY notification_id DESC LIMIT 2");
        return $sql;
    }

    public function selectNotificationsForPensionerWithLimit()
    {
        $sql = $this->connect->query("SELECT * FROM `notification` INNER JOIN `pensioner` ON notification.send_to = pensioner.pensioner_id WHERE notification.send_to = '$this->user_id' ORDER BY notification_id DESC LIMIT 2");
        return $sql;
    }
}
final class profile extends general {}
final class payments_history extends general {}
final class notification extends general {}
