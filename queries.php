<?php

require_once "Database.php";

use Src\Database;

function getData()
{
    $conn = Database::connect();
    $sql = "SELECT i.*, gr.id AS member_id, gr.first_name AS member_first_name, gr.last_name AS member_last_name, gr.passport_number AS member_passport_number
                FROM `insurances` AS i
                LEFT JOIN `group_insurance_members` AS gr
                ON i.id = gr.insurance_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        
        return "No data at the momet.";
    }

    $insurances = [];

    foreach ($result as $row) {
        $insuranceId = $row['id'];
        
        if (!isset($insurances[$insuranceId])) {

            $insurances[$insuranceId] = [
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'birthdate' => $row['birthdate'],
                'travel_date_from' => $row['travel_date_from'],
                'travel_date_to' => $row['travel_date_to'],
                'passport_number' => $row['passport_number'],
                'phone_number' => $row['phone_number'],
                'insurance_type' => $row['insurance_type'],
                'group_members' => []
            ];
        }

        // Add group member if exists
        if ($row['member_id'] !== null) {
            $insurances[$insuranceId]['group_members'][] = [
                'id' => $row['member_id'],
                'first_name' => $row['member_first_name'],
                'last_name' => $row['member_last_name'],
                'passport_number' => $row['member_passport_number']
            ];
        }
    }

    $insurances = array_values($insurances);

    return $insurances;
}

function insertInsurance($input, $members = [])
{
    if (empty($input)) {

        return "Input array cannot be empty.";
    }
    
    try {
        $conn = Database::connect();

        $columns = array_keys($input);
        $placeholders = array_map(fn($col) => ":$col", $columns);
        
        //  $sql = "INSERT INTO `insurances` (". implode(", ", array_keys($input)) . ") VALUES ( :" . implode(", :", array_keys($input)) . ')';
        $sql = "INSERT INTO `insurances` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $placeholders) . ")";

        $stmt = $conn->prepare($sql);

        $stmt->execute($input);
        $insurance_id = $conn->lastInsertId();

        if (!empty($members)) {

            foreach ($members as $index => $member) {
                $member['insurance_id'] = $insurance_id;
                $memberColumns = array_keys($member);
                $memberPlaceholders = array_map(fn($col) => ":$col", $memberColumns);

                $sql_group = "INSERT INTO `group_insurance_members` (" . implode(", ", $memberColumns) . ") VALUES (" . implode(", ", $memberPlaceholders) . ")";
                $stmt_group = $conn->prepare($sql_group);

                $stmt_group->execute($member);
            }
        }

        return true;
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        
        return false;
    }
}