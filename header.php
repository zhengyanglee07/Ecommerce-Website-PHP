<?php
session_start();
include "database.php";



/*Check for valid login */
if (isset($_POST["email"]) && isset($_POST["pswd"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["pswd"];
    $sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION["uid"] = $row["user_id"];
    $_SESSION["name"] = $row["first_name"];


    header("Refresh:0");
}

if (isset($_POST['loginSubmit'])) {

    if(isset($_SESSION["uid"])){
        echo "<script> alert(\"Login Successful\"); </script>";
    }else{
        echo "<script type='text/javascript'> alert(\"Wrong Email or Password! Please enter again\");
                        $((document).ready{
                            $('#loginSubmit').click(function() {
                                alert('Logining');
                            })
                        })
                        </script>";

    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <!--Bootstrap-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/product/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!--Slide-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!---->

    <!--Slicky-->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!---->

    <!--Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Image Zoom-->
    <script src='js/jquery.zoom.js'></script>

    <!--Rating and Review-->
    <script type="text/javascript" src="js/rating.js"></script>

    <!--Custom-->
    <link href="assets/dist/css/bootstrap.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/rating.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
    <script type="text/javascript" src="js/effect.js"></script>
    <title><?php echo $PAGE_TITLE ?></title>
    <!---->
    <script>
        $(document).ready(function () {
            $('#ex1').zoom();
            $('#tab1').tab('show');

            //To enable change the quantity of product added into the cart
            $('.modifyCart').click(function () {
                $("input[id='quantity']").removeAttr("readonly");
            });

            activeTab('tab1');

            $('#product-tab a').click(function(e){
                e.preventDefault();
                $(this).parent().removeClass('active');
            })
        });

        function activeTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        }

        function submitCheck(checkBox){
            if(checkBox.checked){
                document.getElementById('ckSubmit').disabled = false;

            }else{
                document.getElementById('ckSubmit').disabled = true;

            }
        }

        function openLoginModal(){
            $(document).ready(function(){
                $('.add-to-cart-btn').click(function(){
                    $('#Modal_login').modal('show');
                })
            })
        }


    </script>
</head>

<body>
<script>
    Splitting();
</script>


<nav id="nav" class="sticky-top">
    <div class="container-fluid row">
        <div id="logo" class="col-3 ">
            <!--Animation Font - Breathing-->
            <span><a href="index.php" data-splitting=""><img src="img/logo/logo.jpeg" alt="logo">
                <span class="word" data-word="Breathing" style="--word-index:0;">
                <span class="char" data-char="N" style="--char-index:0;">N</span>
                <span class="char" data-char="O" style="--char-index:1;">O</span>
                <span class="char" data-char='B' style="--char-index:3;">B</span>
                <span class="char" data-char="L" style="--char-index:4;">L</span>
                <span class="char" data-char="E" style="--char-index:5;">E</span>
                <span class="char" data-char="&nbsp;" style="--char-index:6;">&nbsp;</span>
                <span class="char" data-char="P" style="--char-index:7;">P</span>
                <span class="char" data-char="H" style="--char-index:8;">H</span>
                <span class="char" data-char="O" style="--char-index:9;">O</span>
                <span class="char" data-char="E" style="--char-index:10;">E</span>
                <span class="char" data-char="N" style="--char-index:11;">N</span>
                <span class="char" data-char="I" style="--char-index:12;">I</span>
                <span class="char" data-char="X" style="--char-index:13;">X</span>
            </span></a></span>
        </div>
        <!--end-Animation Font - Breathing-->

        <!--search bar-->
        <div class="col-5">
            <form action="product-categories.php" method="get">
                <!--Search by Categories-->
                <select id="select-categ" name="categ">
                    <option value="0">All Categories</option>
                    <?php include_once "helpher.php";
                    $categ = getCategory();
                    for($i=0; $i<sizeof($categ); $i++){
                        printf("<option value=%d>%s</option>",$categ[$i]['id'] ,$categ[$i]['title']);
                    }
                    ?>
                </select>
                <!--end-Search by Categories-->

                <!--Search by Keyword-->
                <input id="search" style="width: 200px" type="text" name="keyWord" placeholder="  Search here">
                <input type="submit" id="search-btn" name="search-btn" class="btn btn-outline-success" value="SEARCH">
                <!--end-Search by keyWord-->
            </form>
        </div>

        <div class="dropdown position-relative " style="margin-right: 15px;">
            <img class="icon" src="img/icon/cart.png">
            <button class="dropbtn">Cart</button>
            <?php
            $temp = array_keys($_COOKIE);
            $count = 0;
            for ($i = 0; $i < count($temp); $i++) {
                if (preg_match("/cart/", $temp[$i])) {
                    $count++;
                    $conn = @mysqli_connect($hostname, $username, $password, $database) or
                    die ('Could not connect to MySQL: ' . mysqli_connect_error());

                    $cartID = preg_replace("/cart/", "", $temp[$i]);
                    $sql = "select * from products where product_id ='$cartID'";                                                        //获取指定商品全部信息
                    $result = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_array($result);

                }
            }
            /*show quantity of product have been add to cart*/
            echo "<div id=\"qty\">$count</div>";

            /*cart body - show product list added into cart*/
            echo "<div class=\"dropdown-content\" style=\"width: 400px;\">";
            echo "<div class=\"cart-product position-relative\">";
            echo "<table style='width: 400px;'>";
            echo "<tr><td>No.</td><td>Product</td><td>Price</td><td>QTY</td></tr>";
            $index = 0;
            $temp = array_keys($_COOKIE);
            for ($i = 0; $i < count($temp); $i++) {
                if (preg_match("/cart/", $temp[$i])) {

                    $conn = @mysqli_connect($hostname, $username, $password, $database) or
                    die ('Could not connect to MySQL: ' . mysqli_connect_error());

                    $cartID = preg_replace("/cart/", "", $temp[$i]);
                    $sql = "select * from products where product_id ='$cartID'";                                                        //获取指定商品全部信息
                    $result = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_array($result);

                    $prod_id = $rows['product_id'];
                    $prod_title = $rows['product_title'];
                    $prod_quantity = $rows['product_quantity'];
                    $product_promo_price = $rows['product_promo_price'];
                    $prod_image = explode(",", $rows['product_image']);

                    $qty = $_COOKIE["cart$prod_id"];
                    $index++;


                    echo "<tr><td>".$index."</td><td><img src='Admin/Product%20Image/".$prod_image[0]." ' width='80px' height='70px'>&nbsp;</td><td>".round($product_promo_price,2)."</td><td>$qty</td></tr>";
                }
            }
            echo "<tr><td colspan='4'><button class=\"btn btn-success\" style=\"width: 100%;\" onclick=\"location = 'cart.php'\">Edit Cart</button></td></tr>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            ?>
        </div>

        <?php
        if (isset($_SESSION["uid"])) {
            $sql = "SELECT first_name FROM user_info WHERE user_id='$_SESSION[uid]'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);

            echo '
                <div class="dropdown">
                    <img class="icon" src="img/icon/account.png">
                    <button class="dropbtn"> HI ' . $row["first_name"] . '</button>
                    <div class="dropdown-content">
                        <a href="myProfile.php"><i aria-hidden=\"true\"></i>My Profile</a>
                        <a href="logout.php"><i aria-hidden="true"></i>Log Out</a>
                    </div>
                </div>';
        } else {
            echo "
                <div class=\"dropdown\">
                    <img class=\"icon\" src=\"img/icon/account.png\">
                    <button class=\"dropbtn\">Account</button>
                    <div class=\"dropdown-content\">
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#Modal_login_Admin\"><i aria-hidden=\"true\"></i>Admin Login</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#Modal_login\"><i aria-hidden=\"true\"></i>User Login</a>
                        <a href=\"registration.php\"><i aria-hidden=\"true\"></i>Register</a>
                    </div>
                </div>";
        }

        ?>

    </div>
</nav>

<!--Login Modal for User-->
<div class="modal position-sticky " id="Modal_login" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content section-shadow"
             style="background-image: url(img/bg_img/login1.jpg);background-size: cover; background-repeat: no-repeat">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <?php include('login.php'); ?>
            </div>
        </div>

    </div>
</div>

<!--Login Modal for Admin-->
<div class="modal position-sticky " id="Modal_login_Admin" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content section-shadow"
             style="background-image: url(img/bg_img/login1.jpg);background-size: cover; background-repeat: no-repeat">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <?php include('adminLogin.php'); ?>
            </div>
        </div>

    </div>
</div>

