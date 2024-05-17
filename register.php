<?php 

require_once "Database.php";
require_once "helpers.php";
require_once "queries.php";

use Src\Database;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = [];

    $input = json_decode(file_get_contents('php://input'), true);

    $validation = validateForm($input);
    // echo "<pre>";var_dump($validation);die;
        if (count($validation['errors']) > 0) {
            $response['success'] = false;
            $response['status'] = 422;
            $respponse['errors'] = $validation['errors'];
            $response = json_encode($response);
        } else {

            $data = $validation['data'];
            $group_insurance_members = $data['group_insurance_members'] ?? [];
            unset($data['group_insurance_members']);

            try {
                $db_fdbck = insertInsurance($data, $group_insurance_members);
                $response['success'] = (bool) $db_fdbck;
                $response['message'] = ($db_fdbck == true) ? "Polisa je uspesno sacuvana." : "Doslo je do greske prilikom upisa u bazu.";
            } catch (Exception $e) {
                $response['success'] = false;
                $response['message'] = "Doslo je do greske prilikom upisa u bazu: " . $e->getMessage();
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        
        exit;
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    
    exit;
}

function validateForm($input = [])
{
    $data = [];
    $errors = [];
    // validate first-name
    if (empty($input["first-name"])) {
        $errors['first-name'] = "Ovo polje je obavezno.";
    } else {
        $first_name = input_data($input["first-name"]);
        // check if name only contains letters and whitespace and dots
        if (!preg_match("/^[a-zA-Z. ]*$/", $first_name)) { // (!preg_match("/^[\p{Latin}\p{Cyrillic}. ]*$/u", $string)) {
            $errors['first_name'] = "Uneto polje sadrzi nedozvoljne karaktere.";
        }
        $data['first_name'] = $first_name;
    }

    // validate last-name
    if (empty($input["lastname"])) {
        $errors['last_name'] = "Ovo polje je obavezno.";
    } else {
        $last_name = input_data($input["lastname"]);
        // check if name only contains letters and whitespace and dots
        if (!preg_match("/^[a-zA-Z. ]*$/", $last_name)) {
            $errors['last_name'] = "Uneto polje sadrzi nedozvoljne karaktere.";
        }
        $data['last_name'] = $last_name;
    }

    // validate email
    if (empty($input['email'])) {
        $errors['email'] = "Ovo polje je obavezno.";
    } else {
        $email = input_data($input['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Nevazeci format mejl adrese.";
        }
        $data['email'] = $email;
    }

    // validate birthdate
    if (empty($input["birthdate"])) {
        $errors['birthdate'] = "Ovo polje je obavezno.";
    } else {
        $birthdate = input_data($input["birthdate"]);
        // check if name only contains letters and whitespace and dots
        if (!validateDate($birthdate)) {
            $errors['birthdate'] = "Neispravan datum.";
        }
        $data['birthdate'] = $birthdate;
    }

    // validate travel-date-from
    if (empty($input["travel-date-from"])) {
        $errors['travel_date_from'] = "Ovo polje je obavezno.";
    } else {
        $travel_date_from = input_data($input["travel-date-from"]);
        // check if name only contains letters and whitespace and dots
        if (!validateDate($travel_date_from)) {
            $errors['travel_date_from'] = "Neispravan datum.";
        }
        $data['travel_date_from'] = $travel_date_from;
    }

    // validate travel-date-to
    if (empty($input["travel-date-to"])) {
        $errors['travel_date_to'] = "Ovo polje je obavezno.";
    } else {
        $travel_date_to = input_data($input["travel-date-to"]);
        // check if name only contains letters and whitespace and dots
        if (!validateDate($travel_date_to)) {
            $errors['travel_date_to'] = "Neispravan datum.";
        }
        $data['travel_date_to'] = $travel_date_to;
    }

    if (!isset($errors['travel_date_from']) && !isset($errors['travel_date_to'])) {
        if (!validateTravelDates($travel_date_from, $travel_date_to)) {
            // Invalid dates or "travel-date-to" is older than "travel-date-from"
            $errors['date_difference'] =  "Proverite razmak izmedju datuma.";
        }
    }

    // validate passport number
    if (empty($input["passport-number"])) {
        $errors['passport_number'] = "Broj pasosa je obavezno polje.";
    } else {
        $passport_number = input_data($input["passport-number"]);
        // check if name only contains letters and whitespace and dots
        if (!preg_match("/^[0-9. ]*$/", $passport_number)) {
            $errors['passport_number'] = "Uneto polje sadrzi nedozvoljne karaktere.";
        }
        $data['passport_number'] = $passport_number;
    }

    // validate pgone number
    if (!empty($input["phone-number"])) {
        $phone_number = input_data($input["phone-number"]);
        // check if name only contains letters and whitespace and dots
        if (!preg_match("/^[0-9. ]*$/", $phone_number)) {
            $errors['phone_number'] = "Uneti broj telefona sadrzi karaktere koji nisu brojevi.";
        }
        $data['phone_number'] = $phone_number;
    }

    // validate insurance-type
    if (empty($input["insurance-type"])) {
        $errors['insurance_type'] = "Tip osiguranja je obavezno polje.";
    } else {
        $insurance_type = input_data($input["insurance-type"]);
        // check if name only contains letters and whitespace and dots
        if (!preg_match("/^[a-zA-Z. ]*$/", $insurance_type)) {
            $errors['insurance_type'] = "Uneto polje sadrzi nedozvoljne karaktere.";
        }
        $data['insurance_type'] = $insurance_type;
    }

    // GROUP INSURANCE MEMBERS
    if ($input['insurance-type'] == 'group') {
        $additional_first_names = $input['additional-first-name'] ?? [];
        $additional_last_names = $input['additional-last-name'] ?? [];
        $additional_passport_numbers = $input['additional-passport-number'] ?? [];

        foreach ($additional_first_names as $index => $add_first_name) {
            $add_first_name = input_data($additional_first_names[$index]);

            if (empty($add_first_name) || !preg_match("/^[a-zA-Z. ]*$/", $add_first_name)) {
                $errors['additionalPersons'][$index]['firstname'] = "Uneto polje sadrzi nedozvoljne karaktere.";
            }

            $add_last_name = input_data($additional_last_names[$index]);

            if (empty($add_last_name) || !preg_match("/^[a-zA-Z. ]*$/", $add_last_name)) {
                $errors['additionalPersons'][$index]['firstname'] = "Uneto polje sadrzi nedozvoljne karaktere.";
            }
            
            $add_passport_number = input_data($additional_passport_numbers[$index]);
            
            if (empty($add_passport_number) || !preg_match("/^[a-zA-Z0-9]*$/", $add_passport_number)) {
                $errors['additionalPersons'][$index]['firstname'] = "Uneto polje sadrzi nedozvoljne karaktere.";
            }
            
            $data['group_insurance_members'][] = [
                'first_name' => $add_first_name,
                'last_name' => $add_last_name,
                'passport_number' => $add_passport_number
            ];
        }
    }

    return ['errors' => $errors, 'data' => $data];
}
