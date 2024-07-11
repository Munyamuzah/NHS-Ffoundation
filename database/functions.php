<?php

include 'connection.php';

$action = $_GET['action'];

switch ($action) {
    case 'addPatient':
        addPatient();
        break;
    case 'addQuestion':
        addQuestion();
        break;
    case 'addScore':
        addScore();
        break;
    case 'getPatients':
        getPatients();
        break;
    case 'getQuestions':
        getQuestions();
        break;
    
    default:
        echo 'Invalid action';
}



function addPatient() {
    global $connection;
    $fname = $_POST['firstName'];
    $sname = $_POST['surname'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $score = $_POST['age'];
    $date = date('Y-m-d');
    $sql = "{CALL sp_CreatePatient(?, ?, ?, ?, ?)}";
    $params = array($fname, $sname, $dob, $age, $score, $date);
    $stmt = sqlsrv_query($connection, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo json_encode(['status' => 200, 'message' => 'Patient added successfully']);
    }
}

function addPainInventory() {
    global $connection;
    $patient_id = $_POST['p_patient_id'];
    $total_score = $_POST['p_total_score'];
    $submission_date = $_POST['p_submission_date'];
    $sql = "{CALL sp_CreatePainInventory(?, ?, ?)}";
    $params = array($patient_id, $total_score, $submission_date);

    $stmt = sqlsrv_query($connection, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Pain inventory added successfully";
    }
}

function addQuestion() {
    global $connection;
    $details = $_POST['q_details'];
    $highest_mark = $_POST['q_highest_mark'];
    $sql = "{CALL sp_CreateQuestion(?, ?)}";
    $params = array($details, $highest_mark);

    $stmt = sqlsrv_query($connection, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Question added successfully";
    }
}

function addScore() {
    global $connection;
    $patient_id = $_POST['s_patient_id'];
    $question_id = $_POST['s_question_id'];
    $question_score = $_POST['s_question_score'];
    $sql = "{CALL sp_CreateScore(?, ?, ?)}";
    $params = array($patient_id, $question_id, $question_score);
    $stmt = sqlsrv_query($connection, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Score added successfully";
    }
}

function getPatients() {
    
        global $connection;
    
        $sql = "{CALL sp_GetPatients()}";
    
        $stmt = sqlsrv_query($connection, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $patients = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $patients[] = $row;
            }
            echo json_encode($patients);
        }
}


function getQuestions() {    
    global $connection;
    $sql = "{CALL sp_GetQuestions()}";
    $stmt = sqlsrv_query($connection, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        $questions = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $questions[] = $row;
        }
        echo json_encode($questions);
    }
}