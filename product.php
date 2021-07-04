<?php
$PAGE_TITLE = "Product";

if(isset($_SESSION['first'])){
    header('Refresh: 0');
    unset($_SESSION['first']);
}
include('header.php');
include('database.php');
/*Rating and Review*/

/*Store rate and review into database*/
date_default_timezone_set("Asia/Kuala_Lumpur");
$rate_dt = date('d M Y h:i:s A');
if (isset($_POST['rate-submit'])) {
    $sql = "UPDATE product_review SET user_name ='" . $_POST['rn'] . "' ,user_email ='" . $_POST['re'] . "' ,
                    description='" . $_POST['desc'] . "' ,rate_time='$rate_dt' WHERE product_id ='" . $_GET['prodID'] . "' AND user_id='" . $_SESSION['uid'] . "' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $checkRID = mysqli_query($conn, "SELECT id FROM product_review WHERE user_id = '" . $_SESSION['uid'] . "' AND product_id = '" . $_GET['prodID'] . "' ");
        while ($row = mysqli_fetch_assoc($checkRID)) {
            $rID = $row['id'];
        }
        $sql2 = "UPDATE rating SET rating = '" . $_POST['rs'] . "' WHERE review_id = '$rID' ";
        $result2 = mysqli_query($conn, $sql2);

    }
}

include_once "rating.php";
if (isset($_SESSION['uid'])) {
    $user_id = $_SESSION['uid'];
} else {
    $user_id = '';
}
$result = getAllPost($_GET['prodID']);

/*Set the latest quantity of product to the cookie*/
$prod_id = $_GET['prodID'];
if (isset($_COOKIE["cart$prod_id"])) {
    if (isset($_POST['qty'])) {
        if ($_COOKIE["cart$prod_id"] != $_POST['qty']) {
            echo "
            <script type='text/javascript'>
                window.onload= function(){
                    var expdate = new Date();
                    expdate.setTime(expdate.getTime() + ( 30 * 60 * 1800));  // 30 * 60 * 1800
                    document.cookie = \"cart" . $prod_id . "\"+\"=\"+\"" . $_POST['qty'] . "\"+\";expires=\"+expdate.toGMTString()+\";path=/\";
                    /*alert(\"Update Successful!\");*/
                };
            </script>
           
            ";
        }
    }
}


if (isset($_GET['prodID'])) :
    include_once "helpher.php";
    $product = getProdDetail($_GET['prodID']);
    $image = explode(',', $product['image']);

    /*Prompt customer if product is out of stock*/
    if (isset($_POST['prod_checkOut'])) {
        if ($product['qty'] < 1) {
            echo "<div class='error'>Sorry, this product is <strong>OUT OF STOCK</strong></div>";
        }
    }
    ?>


    <br>
    <!--Product-->
    <div class="container-fluid bg-light row m-auto" style="width: 90%;height: 500px;x; ">
        <!--Preview Images-->
        <div class="col-2 preview-img section-shadow overflow-auto col-md-push-2" style="height: 500px;">
            <?php
            if (is_array($image)) {
                for ($i = 0; $i < sizeof($image); $i++) {
                    echo "
                    <a>
                    <div><img id='img'  src=\"Admin/Product%20Image/$image[$i]\"></div>
                 </a>
                    ";

                }
            } else {
                echo " <a>
                    <div><img id='img'  src=\"Admin/Product%20Image/$image[0]\"></div>
                 </a>";
            }
            ?>
        </div>


        <!--end-Preview Images-->

        <div class="col-5">
              <span class=" zoom" id="ex1">
            <img src='Admin/Product%20Image/<?php echo $image[0] ?>' width='555' height='320'
                 alt='Daisy on the Ohoopee'/>
        </span>
        </div>


        <!--Product detail-->
        <div class="col-5 product-detail">
            <h1 style="font-weight:900; font-family:'Audrey';"><?php echo $product['name'] ?></h1>
            <div>
                <div class="product-rating">
                    <?php
                    $rstar = ratingStar($product['id']);

                    if($rstar !=0){
                        for($i=0; $i < $rstar; $i++){
                            echo "<i class=\"fa fa-star\"></i>";
                        }
                        for($i=0; $i < 5-$rstar; $i++){
                            echo "<i class=\"fa fa-star-o\"></i>";
                        }
                    }else{
                        for($i=0; $i < 5; $i++){
                            echo "<i class=\"fa fa-star\"></i>";
                        }
                    }
                    ?>
                </div> &nbsp;&nbsp;
                <a class="review-link" data-toggle="tab" href="#tab3" style=""> <a
                            href="#reviews"><?php echo isset($_SESSION['ratingTTL']) ? $_SESSION['ratingTTL'] : '0' ?>
                        Review(s) | Add
                        your review</a></a>
                <a href="#" title="Add To Wishlist"><i class="fa fa-heart-o"
                                                       style="padding-left: 20px;font-size: 15px"></i></a>
            </div>


            <h4 class=\"product-current-price\">RM <?php echo $product['promo_price'] ?>
                <del class=\"product-old-price\"
                     style="font-size: 17px; color: #4e555b"><?php echo $product['price'] ?></del>

                <span class="product-available"><?php echo ($product['published'] > 0) ? 'In Stock( ' . $product['published'] . ' )' : 'Out of Stock' ?></span>
            </h4>

            <p><?php echo $product['desc'] ?></p>

            <!--Option of product -->
            <form method="post" action="<?php echo ($product['published'] > 0) ? 'checkout.php' : '' ?>"
                  enctype="multipart/form-data">
                <div class="product-options">
                    <label>
                        <p>QTY</p>
                        <input style="width: 70px;" id="quantity" name="quantity[0]" type="number"
                               value="<?php echo ($product['qty'] > 0) ? 1 : 0 ?>" min="0"
                               max="<?php echo $product['qty'] ?>">
                    </label>
                </div>

                <input type="hidden" name="prodID[0]" value="<?php echo $prod_id ?>">
                <input type="submit" formaction="" id="updateCookie" class="btn btn-info cart-btn"
                       onclick=SetCookie("cart<?php echo $product['id'] ?>","1") value="ADD TO CART">
                <input type="submit" class="btn btn-info buy-btn" name="prod_checkOut" value="BUY NOW">
            </form>

        </div>
        <!--end-Product detail-->
    </div>
    <!--end-Product-->


    <!--Product-tab-->
    <div class="container-fluid  bg-light" style="width:90%;">
        <div id="product-tab" class="text-center">
            <!-- product tab nav -->
            <ul class=" link-effect nav nav-tabs " style="padding-left: 39%; margin-bottom: 30px">
                <li class="nav-item"><a href="#tab1" data-toggle="tab" role="tab">Description </a></li>
                <li class="nav-item"><a href="#tab2" data-toggle="tab" role="tab">Details</a></li>
                <li class="nav-item"><a href="#tab3" data-toggle="tab" role="tab">Reviews
                        (<?php echo isset($_SESSION['ratingTTL']) ? $_SESSION['ratingTTL'] : '0' ?>)</a></li>
            </ul>
            <!-- /product tab nav -->

            <!-- product tab content -->

            <div class="tab-content" id="tabs" role="tabpanel">
                <!-- tab1  -->
                <div id="tab1" class="tab-pane fade in">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php echo $product['desc']; ?></p>
                        </div>
                    </div>
                </div>
                <!-- end-tab1  -->

                <!-- tab2  -->
                <div id="tab2" class="tab-pane fade in" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php echo $product['desc']; ?></p>
                        </div>
                    </div>
                </div>
                <!-- end-tab2  -->

                <!-- tab3  -->
                <div id="tab3" class="tab-pane fade in" role="tabpanel">
                    <div class="row">
                        <!--Rating-->
                        <div class="col-md-3">
                            <div id="rating">
                                <div class="rating-avg">
                                    <?php
                                    global $average, $rev;
                                    $rate = getAllPost($_GET['prodID']);
                                    $cnt = 0;
                                    if(is_array($rate)){
                                        foreach ($rate as $review) {
                                            if (!empty($review["rating_total"])) {
                                                $average += round(($review["rating_total"] / $review["rating_count"]), 1);
                                                $rev = $review["rating_count"];
                                                $cnt++;
                                            }else{
                                                echo "<span>5</span>";
                                            }
                                        }
                                    }

                                    $_SESSION['ratingTTL'] = $cnt;
                                    $rstar = ratingStar($prod_id);

                                    if($rstar != 0){
                                        $average = $rstar;
                                    }else{
                                        $average = 5;
                                    }
                                    echo "<span>" . $average . "</span>";
                                    echo " <div class=\"rating-stars\">";
                                    $avg = round($average, 2);
                                    for ($i = 0; $i < $avg; $i++) {
                                        echo "<i class=\"fa fa-star\"></i>";
                                    }
                                    for ($i = 0; $i < round(5 - $average); $i++) {
                                        echo "<i class=\"fa fa-star-o\"></i>";
                                    }
                                    echo "</div>";
                                    echo "<span style='font-size: 12px; color:grey;'>&nbsp;&nbsp;" . $rev. "</span>";
                                    ?>
                                </div>
                                <ul class="rating">
                                    <li>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-progress">
                                            <div style="width: <?php echo $rp = round((getTotalRating('$prod_id', '5') / $review['rating_count']) * 100) ?>%;"></div>
                                        </div>
                                        <span class="sum"><?php echo getTotalRating($prod_id, '5'); ?></span>
                                    </li>
                                    <li>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="rating-progress">
                                            <div style="width: <?php echo $rp = round((getTotalRating('$prod_id', '4') / $review['rating_count']) * 100) ?>%;"></div>
                                        </div>
                                        <span class="sum"><?php echo getTotalRating($prod_id, '4'); ?></span>
                                    </li>
                                    <li>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="rating-progress">
                                            <div style="width: <?php echo $rp = round((getTotalRating('$prod_id', '3') / $review['rating_count']) * 100) ?>%;"></div>
                                        </div>
                                        <span class="sum"><?php echo getTotalRating($prod_id, '3'); ?></span>
                                    </li>
                                    <li>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="rating-progress">
                                            <div style="width: <?php echo $rp = round((getTotalRating('$prod_id', '2') / $review['rating_count']) * 100) ?>%;"></div>
                                        </div>
                                        <span class="sum"><?php echo getTotalRating($prod_id, '2'); ?></span>
                                    </li>
                                    <li>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="rating-progress">
                                            <div style="width: <?php echo $rp = round((getTotalRating('$prod_id', '1') / $review['rating_count']) * 100) ?>%;"></div>
                                        </div>
                                        <span class="sum"><?php echo getTotalRating($prod_id, '1'); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--Rating-->

                        <!--Review-->
                        <div class="col-md-6">
                            <div id="reviews">
                                <ul class="reviews">
                                    <?php
                                    $sql = "SELECT * FROM product_review PV, Rating R WHERE PV.id = R.review_id AND PV.product_id = '" . $_GET['prodID'] . "' ";
                                    $rslt = mysqli_query($conn, $sql);

                                    if ($rslt) {
                                        while ($row = mysqli_fetch_assoc($rslt)) {
                                            echo "
													<li>
														<div class=\"review-heading\" >
														<h5 class=\"name\">" . $row['user_name'] . "</h5>
														<p class=\"date\">" . $row['rate_time'] . "</p>
														<div class=\"review-rating\">";

                                            for ($i = 0; $i < $row['rating']; $i++) {
                                                echo "<i class=\"fa fa-star\"></i>";
                                            }
                                            for ($i = 0; $i < (5 - $row['rating']); $i++) {
                                                echo "<i class=\"fa fa-star-o\"></i>";
                                            }

                                            echo "    
														</div>
													</div>
													<div class=\"review-body\">
														<p>" . $row['description'] . "</p>
													</div>
												</li>";

                                        }
                                    } else {
                                        echo "<div class='error'>No Have Any Comment</div>";
                                    }

                                    ?>
                                </ul>
                                <ul class="reviews-pagination">
                                    <li class="active">1</li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--Reviews-->

                        <!-- Review Form -->
                        <div class="col-md-3">
                            <form action="product.php?prodID=<?php echo $prod_id ?>" method="post" id="review-form"
                                  class="section-bgColor section-shadow">
                                <table class="ratingAndReview">
                                    <tbody>
                                    <?php
                                    if (isset($_SESSION['uid'])) {
                                        $user = getUserInfo($_SESSION['uid']);
                                        $uid = $_SESSION['uid'];

                                        if (isset($_POST['rate-submit'])) {
                                            $sql = "SELECT * FROM product_review PV WHERE product_id = '$prod_id' AND user_id = '$uid' ";
                                            $result0 = mysqli_query($conn, $sql);
                                            $num = mysqli_num_rows($result0);

                                            if ($num == 0) {
                                                $sql1 = "INSERT INTO `product_review`(`user_id` , `product_id`) VALUES ('$uid','$prod_id')";
                                                $result1 = mysqli_query($conn, $sql1);

                                                if ($result1) {
                                                    $checkRID = mysqli_query($conn, "SELECT id FROM product_review WHERE user_id = '$uid' AND product_id = '$prod_id'");
                                                    while ($row = mysqli_fetch_assoc($checkRID)) {
                                                        $rID = $row['id'];
                                                    }
                                                    $sql2 = "INSERT INTO `rating`(`review_id`, `user_id`, `rating`) VALUES ('$rID','$uid','5')";
                                                    $result2 = mysqli_query($conn, $sql2);
                                                    if ($result2) {
                                                        echo "<script type='text/javascript'> window.location.reload(true) </script>";
                                                    }
                                                }
                                            }
                                        }

                                        $i = 0;
                                        $result = getAllPost($_GET['prodID']);
                                        if(is_array($result)){
                                            foreach ($result as $review) {
                                                $ratingResult = getRating($review["id"], $user_id);
                                                $ratingVal = "";
                                                if (!empty($ratingResult[0]["rating"])) {
                                                    $ratingVal = $ratingResult[0]["rating"];
                                                }

                                            }
                                        }else{
                                            $review = $result;
                                            $ratingResult = getRating($review["id"], $user_id);
                                                $ratingVal = "";
                                                if (!empty($ratingResult[0]["rating"])) {
                                                    $ratingVal = $ratingResult[0]["rating"];
                                                }
                                        }

                                        ?>
                                        <tr>
                                            <td>
                                                <!--rn = rating-username, re = rating-user email, rs = rating star-->
                                                <label for="rn">Name</label>
                                                <div class="feed_title"><input id="rn" type="text" name="rn"
                                                                               readonly
                                                                               value="<?php echo $user['fname']; ?>  ">
                                                </div>
                                                <label for="re">Email</label>
                                                <div class="feed_title"><input id="re" type="email" name="re"
                                                                               readonly
                                                                               value="<?php echo $user['email']; ?>  ">
                                                </div>
                                                <div id="review-<?php echo $review["id"]; ?>"
                                                     class="star-rating-box">
                                                    <input type="hidden" name="rs" id="rating"
                                                           value="<?php echo $ratingVal; ?>"/>
                                                    <ul
                                                            onMouseOut="resetRating(<?php echo $review["id"]; ?>);">
                                                        <?php
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            $selected = "";
                                                            if (!empty($ratingResult[0]["rating"]) && $i <= $ratingResult[0]["rating"]) {
                                                                $selected = "selected";
                                                            }
                                                            ?>
                                                            <li class='<?php echo $selected; ?>'
                                                                onmouseover="highlightStar(this,<?php echo $review["id"]; ?>);"
                                                                onmouseout="removeHighlight(<?php echo $review["id"]; ?>);"
                                                                onClick="addRating(this,<?php echo $review["id"]; ?>);">
                                                                &#9733;
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div><textarea name="desc" cols="25" rows="2"
                                                               placeholder="Write your review here"><?php echo $review["description"]; ?></textarea>
                                                </div>
                                                <input type="submit" name="rate-submit" value="Submit"
                                                       class="btn btn-info w-100">
                                            </td>
                                        </tr>
                                        <?php

                                    }else{
                                        echo "You haven't login yet. Please login to comment";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- /Review Form -->
                    </div>
                </div>
                <!-- end-tab3  -->
            </div>
            <!-- /product tab content  -->
        </div>
    </div>
    <!-- end-Product tab -->

<?php
else:
    echo '<div class="error">* No Product Choose! <a href="index.php">Click Here</a> to view our product.</div>';
endif;

include('footer.php');
?>
