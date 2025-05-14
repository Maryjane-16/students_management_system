<?php

function formValidation($full_name, $username, $faculty, $department, $admission_type, $admission_date){

    $errors = [];

    if ($full_name == ''){
        $errors[] = "The full name field must not be empty.";
    }
    if ($username == ''){
        $errors[] = "The username field must not be empty.";
    }
    if ($faculty == ''){
        $errors[] = "The faculty field must not be empty.";
    }
    if ($department == ''){
        $errors[] = "The department field must not be empty.";
    }
    if ($admission_type == ''){
        $errors[] = "The admission type field must not be empty.";
    }
    if ($admission_date == ''){
        $errors[] = "The admission date field must not be empty.";
    }

    return $errors;

}


