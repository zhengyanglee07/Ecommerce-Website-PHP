<?php
include("database.php");

if (isset($_POST['adminSubmit'])) :
    $email = $_POST['email'];
    $password = $_POST['pswd'];


    $sql = "SELECT * FROM admin_info WHERE admin_email = '$email' AND admin_password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) :
        echo "<meta http-equiv=\"refresh\" content=\"0; url=Admin/Admin_Order.php\">";
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#Modal_login').modal('hide');
            })
        </script>
    <?php else: ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#Modal_login').modal('show');
                window.stop();
                $('#loginSubmit').parent().after("<div class='error'>Wrong Username or Password!</div>");

            })
        </script>
    <?php endif ?>
<?php endif ?>

<script type="text/javascript">
    function myFunction() {
        $(document).ready(function (event) {
            event.preventDefault();
        })
    }
</script>

<!--Login Modal-->
<form id="loginForm" action="" class="was-validated animate loginForm w-50" method="post">
    <h1>Admin Login</h1>
    <div class="form-group">
        <label for="eml">Email:</label>
        <input type="text" class="form-control" id="eml" placeholder="Enter email" name="email" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="pswd">Password:</label>
        <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" required> I agree on <a href="#">term and
                condition</a>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Check this checkbox to continue.</div>
        </label>
    </div>
    <input type="hidden" id="validation" name="validation" value="false">

    <input type="submit" name="adminSubmit" id="loginSubmit" onclick="myFunction()" class="btn btn-primary"
           value="Login">
</form>
<!--end-Login Modal-->


