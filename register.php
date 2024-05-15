<?php 

session_start();

require "Database.php";

use Src\Database;

// echo "<pre>";

$errors = $input = $response = [];

function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) === $date;
}

function validateTravelDates($dateFrom, $dateTo) {
    $dateFromObj = DateTime::createFromFormat('Y-m-d', $dateFrom);
    $dateToObj = DateTime::createFromFormat('Y-m-d', $dateTo);

    if (!$dateFromObj || !$dateToObj) {
        // Invalid date format
        return false;
    }

    // Compare dates
    return $dateToObj >= $dateFromObj;
}

if (isset($_POST)) {

        // validate first-name
        if (empty($_POST["first-name"])) {
            $response['errors']['first-name'] = "First Name is required";
        } else {
            $first_name = input_data($_POST["first-name"]);
            // check if name only contains letters and whitespace and dots
            if (!preg_match("/^[a-zA-Z. ]*$/", $first_name)) {
                $response['errors']['first_name'] = "Your name contains unallowed characters";
            }
            $data['first_name'] = $first_name;
        }

        // validate last-name
        if (empty($_POST["lastname"])) {
            $response['errors']['last_name'] = "Last Name is required";
        } else {
            $last_name = input_data($_POST["lastname"]);
            // check if name only contains letters and whitespace and dots
            if (!preg_match("/^[a-zA-Z. ]*$/", $last_name)) {
                $response['errors']['last_name'] = "Your name contains unallowed characters";
            }
            $data['last_name'] = $last_name;
        }

        // validate email
        if (empty($_POST['email'])) {
            $response['errors']['email'] = "Email field is required.";
        } else {
            $email = input_data($_POST['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['errors']['email'] = "Email is not valid.";
            }
            $data['email'] = $email;
        }

        // validate birthdate
        if (empty($_POST["birthdate"])) {
            $response['errors']['birthdate'] = "Birthdate is required";
        } else {
            $birthdate = input_data($_POST["birthdate"]);
            // check if name only contains letters and whitespace and dots
            if (!validateDate($birthdate)) {
                $response['errors']['birthdate'] = "Your birthdate is invalid";
            }
            $data['birthdate'] = $birthdate;
        }

        // validate travel-date-from
        if (empty($_POST["travel-date-from"])) {
            $response['errors']['travel_date_from'] = "Travel date from is required";
        } else {
            $travel_date_from = input_data($_POST["travel-date-from"]);
            // check if name only contains letters and whitespace and dots
            if (!validateDate($travel_date_from)) {
                $response['errors']['travel_date_from'] = "Your travel date from is invalid";
            }
            $data['travel_date_from'] = $travel_date_from;
        }

        // validate travel-date-to
        if (empty($_POST["travel-date-to"])) {
            $response['errors']['travel_date_to'] = "Travel date to is required";
        } else {
            $travel_date_to = input_data($_POST["travel-date-to"]);
            // check if name only contains letters and whitespace and dots
            if (!validateDate($travel_date_to)) {
                $response['errors']['travel_date_to'] = "Your travel date to is invalid";
            }
            $data['travel_date_to'] = $travel_date_to;
        }

        // validate passport number
        if (empty($_POST["passport-number"])) {
            $response['errors']['passport_number'] = "Passport number is required";
        } else {
            $passport_number = input_data($_POST["passport-number"]);
            // check if name only contains letters and whitespace and dots
            if (!preg_match("/^[0-9. ]*$/", $passport_number)) {
                $response['errors']['passport_number'] = "Your passport number contains unallowed characters";
            }
            $data['passport_number'] = $passport_number;
        }

        // validate pgone number
        if (empty($_POST["phone-number"])) {
            $response['errors']['phone_number'] = "Phone number is empty";
        } else {
            $phone_number = input_data($_POST["phone-number"]);
            // check if name only contains letters and whitespace and dots
            if (!preg_match("/^[0-9. ]*$/", $phone_number)) {
                $response['errors']['phone_number'] = "Your phone number contains unallowed characters";
            }
            $data['phone_number'] = $phone_number;
        }

        // validate last-name
        if (empty($_POST["insurance-type"])) {
            $response['errors']['insurance_type'] = "Insurance type is required";
        } else {
            $insurance_type = input_data($_POST["insurance-type"]);
            // check if name only contains letters and whitespace and dots
            if (!preg_match("/^[a-zA-Z. ]*$/", $insurance_type)) {
                $response['errors']['insurance_type'] = "Your insurance type contains unallowed characters";
            }
            $data['insurance_type'] = $insurance_type;
        }

        if (!validateTravelDates($travel_date_from, $travel_date_to)) {
            // Invalid dates or "travel-date-to" is older than "travel-date-from"
            $response['errors'] =  "Invalid travel dates. Please check the date range.";
        }


        if (isset($response['errors']) > 0) {
            $response['status'] = 400;
            $response = json_encode($response);

            echo ($response);
        } else {
            $response['success'] = true;

            $db_fdbck = insertPolicy($data);

            $msg_type = ($db_fdbck == 1) ? "success" : "danger";
            $message = ($db_fdbck == 1) ? "Polisa je uspesno sacuvana." : "Doslo je do greske pri upisu u bazu.";
            
            header("Location:index.php?msg-type=" . $msg_type . "&message=" . $message);
        }

}

// var_dump($_POST);die;

function insertPolicy($input)
{
    if (count ($input)  <= 0) {

        return "can not be empty array. ";
    }
    try {
        $conn = Database::connect();
        $sql = "INSERT INTO `policies` (". implode(", ", array_keys($input)) . ") VALUES ( :" . implode(", :", array_keys($input)) . ')';
        $stmt = $conn->prepare($sql);

        return $stmt->execute($input);

    } catch (\PDOException $e) {
        
        return $e->getMessage();
    }
}

function input_data($data)
{
    $data = ltrim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
