<?php
include "database.php";
global $error;
if (isset($_POST["submit"])) {
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];


    $error = array();

    include('validation.php');
    //check existing email address in database
    $sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1";
    $check_query = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($check_query);

    $error['f_name'] = validateFName($f_name);
    $error['l_name'] = validateLName($l_name);
    $error['email'] = validateEmail($email, $count_email);
    $error['password'] = validatePassword($password);
    $error['repassword'] = validateRePass($password, $repassword);
    $error['mobile'] = validateMobile($mobile);

    /*Run when all error is equal to NULL*/
    if ($error['f_name'] == NULL && $error['l_name'] == NULL && $error['email'] == NULL && $error['password'] == NULL &&
        $error['repassword'] == NULL && $error['mobile'] == NULL) {
        /*Insert value into database*/
        $sql = "INSERT INTO user_info (first_name, last_name, email, password, mobile, address, city, state, zip) VALUES ('$f_name', '$l_name', '$email', '$password', '$mobile', '$address', '$city', '$state', '$city')";
        echo mysqli_connect_error();
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php'); // default page
        }
    }
} else {/*Make all variable as null at start*/
    $f_name = $l_name = $email = $password = $repassword = $mobile = $address = $city = $state = $zip = NULL;
}
//error message style
echo "<style>.error{color:red}</style>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="assets/dist/css/bootstrap.css">

    <link type="text/css" href="css/style.css">
</head>
<style>
    body {
        background-image: url(img/bg_img/registerBG.jpg);
        background-repeat: no-repeat;
        background-size: cover
    }

    #register td {
        width: 600px;
        padding-right: 15px;
    }

    .ltext {
        text-align: right;
    }

    .formStyle {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .divStyle {
        background-color: aliceblue;
        padding: 5px 30px 0px 30px;
        text-align: right;
    }


</style>
</head>

<body>
<section id="regForm" class="container-fluid row position-relative" style="padding: 12px 30px 10px 50px; height: 90%">

    <!--Logo Images at left-->
    <div style="width: 40%" class="col p-0">
        <img src="img/logo/logo.jpeg" alt="logo" style="width: 100%">
    </div>
    <!--Register Form at right-->
    <div class="col divStyle">
        <p style="font-size: 20px;"><a href="index.php">x</a></p>
        <form method="post" action="">
            <h1 style="text-align: center; ">Register here</h1>
            <!--Form Table -->
            <table id="register">
                <!--First Name-->
                <tr class="form-group">
                    <td class="ltext"><label for="f_name">First Name</label></td>
                    <td>
                        <input class="input  formStyle" type="text" name="f_name" id="f_name"
                               placeholder="First Name" value=<?php echo $f_name ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"> <?php echo $error['f_name'] ?>
                    <td>
                </tr>
                <!--First Name-->

                <!--Last Name-->
                <tr>
                    <td class="ltext"><label for="l_name">Last Name</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="text" name="l_name" id="l_name"
                               placeholder="Last Name" value=<?php echo $l_name ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"><?php echo $error['l_name'] ?></td>
                </tr>
                <!--Last Name-->

                <!--Email-->
                <tr>
                    <td class="ltext"><label for="email">Email Address</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="email" name="email" id="email"
                               placeholder="Email" value=<?php echo $email ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"><?php echo $error['email'] ?></td>
                </tr>
                <!--Email-->

                <!--Password-->
                <tr>
                    <td class="ltext"><label for="password">Password</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="password" name="password" id="password"
                               placeholder="password" value=<?php echo $password ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"><?php echo $error['password']; ?></td>
                </tr>
                <!--Password-->

                <!--Re-enter Password-->
                <tr>
                    <td class="ltext"><label for="repassword">Re-enter Password</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="password" name="repassword"
                               id="repassword"
                               placeholder="confirm password" value=<?php echo $repassword ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"><?php echo $error['repassword'] ?></td>
                </tr>
                <!--Re-enter Password-->

                <!--Mobile Phone-->
                <tr>
                    <td class="ltext"><label for="mobile">Mobile Phone</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="text" name="mobile" id="mobile"
                               placeholder="mobile" value=<?php echo $mobile ?>>
                    </td>
                </tr><!--Error Message-->
                <tr>
                    <td>&nbsp;</td>
                    <td class="error"><?php echo $error['mobile'] ?></td>
                </tr>
                <!--Mobile Phone-->

                <!--Address-->
                <tr>
                    <td class="ltext"><label for="address">Address 1</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="text" name="address" id="address"
                               placeholder="Address" value=<?php echo $address ?>>
                    </td>
                </tr>
                <tr>
                    <td rowspan="=2">&nbsp;</td>
                </tr>
                <!--Address-->

                <!--Address 2-->
                <tr>
                    <td class="ltext"><label for="address2">Address 2</label></td>
                    <td>
                        <input class="input input-borders formStyle" type="text" name="city" id="address2"
                               placeholder="City" value=<?php echo $city ?>>
                    </td>
                </tr>
                <tr>
                    <td class="ltext"></td>
                    <td>
                        <input style="width:185px;" type="text" name="state"
                               placeholder="State" value=<?php echo $state ?>>
                        <input type="text" style="width:100px;" maxlength="5" name="zip"
                               placeholder="Zip" value=<?php echo $zip ?>>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <!--Address 2-->

                <!--Button-->
                <tr class="ltext">
                    <td colspan="2" align="right"><input id="btn" type="submit" class="btn btn-primary" name="submit"
                                                         value="Submit">
                    </td>
                </tr>
                <!--Button-->
            </table>
            <!--Form Table-->
        </form>
        <!--Register Form-->
    </div>
</section>
</body>
</html>

