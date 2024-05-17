<?php

function input_data($data)
{
    $data = ltrim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

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

function validateField($field, $input, $regex, $errorMessage, &$data, &$errors) {
    if (empty($input[$field])) {
        $errors[$field] = "Ovo polje je obavezno.";
    } else {
        $value = input_data($input[$field]);
        if (!preg_match($regex, $value)) {
            $errors[$field] = $errorMessage;
        }
        $data[$field] = $value;
    }
}