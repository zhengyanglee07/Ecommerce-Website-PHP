<?php
$PAGE_TITLE = "My Profile";
include("header.php");
include("database.php");


if (isset($_SESSION['uid'])): // Already Login - show content
    $ccrID = $_SESSION['uid']; // current user id that login
    $sql = "SELECT * FROM user_info WHERE user_id = $ccrID";
    $run_query = mysqli_query($conn, $sql);
    $userInfo = mysqli_fetch_assoc($run_query);
    ?>

    <div class="bg-dark container-fluid user_profile position-relative">
        <div class="user_pic"></div>
        <p class="user_name"><?php echo $userInfo['first_name'] . "&nbsp;" . $userInfo['last_name'] ?></p>

    </div>


    <div class="section-shadow section bg-light">
        <div class="container-fluid p-5 view_order_header">
            <h1 class="float-left ">My Order</h1>
            <a href="myOrder.php?select=0" class="float-right">View All Order</a>
        </div>

        <div class="container-fluid row bg-light text-center order_view">
            <div class="col-3">
                <a href="myOrder.php?select=1">
                    <img src="img/icon/to-pay.png" alt="to pay" class="order_icon">
                    <p>To Pay</p>
                </a>
            </div>
            <div class="col-3">
                <a href="myOrder.php?select=2">
                    <img src="img/icon/to-ship.png" alt="to ship" class="order_icon">
                    <p>To Ship</p>
                </a>
            </div>
            <div class="col-3">
                <a href="myOrder.php?select=3">
                    <img src="img/icon/to-receive.png" alt="to-receive" class="order_icon">
                    <p>To Receive</p>
                </a>
            </div>
            <div class="col-3">
                <a href="myOrder.php?select=4">
                    <img src="img/icon/to-review.png" alt="to review" class="order_icon">
                    <p>To Review</p>
                </a>
            </div>
        </div>

    </div>


<?php
else: // Not yet Login - ask to Login
    echo "<div class='error'>You haven't login yet! Please <a href=\"\" data-toggle=\"modal\" data-target=\"#Modal_login\">click here</a> to Login</div>";

endif;

include("footer.php");
?>
