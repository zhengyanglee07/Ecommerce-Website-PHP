<?php
/*----------------------------------------------------*/
/*-------------------Validation Register--------------*/
/*----------------------------------------------------*/

function validateFName($f_name){
    if ($f_name == null) {
        return "* Please fill in your first name!";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $f_name)) {
        return "* Please enter the correct first name ! ";
    } else {
        return NULL;
    }
}


function validateLName($l_name){
    if ($l_name == null) {
        return "* Please fill in your last name!";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $l_name)) {
        return "* Please enter the correct last name ! ";
    } else {
        return NULL;
    }
}

function validateEmail($email,$count_email){
    if ($count_email > 0) {
        return "* Email is exist";
    }else if ($email == null) {
        return "* Please fill in your email!";
    } else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/", $email)) {
        return "* Email entered is not valid!";
    } else {
        return NULL;
    }
}

function validatePassword($password){
    if ($password == null) {
      return "* Please fill in your password!";
    } else {
        return NULL;
    }
}

function validateRePass($password,$repassword){
    if ($repassword == null) {
        return "* Please Re-enter password!";
    } else if ($password != $repassword) {
        return "* Re-enter password is wrong!";
    } else {
        return NULL;
    }
}

function validateMobile($mobile){
    if (!preg_match("/^[0-9]+$/", $mobile)) {
        return "* Wrong mobile number format!";
    } else if (!(strlen($mobile) == 10)) {
        return "* Mobile Number is not valid";
    } else {
        return NULL;
    }
}
?>

