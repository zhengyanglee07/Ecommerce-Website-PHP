<?php
$PAGE_TITLE = "NOBLE PHOENIX";

/*function addToCart($prodId) {
	if(!isset($_SESSION['uid'])){
            echo "<script> window.onload = openLoginModal();</script>";

	}else{
	    echo "<script>window.onload = SetCookie(".'cart'.$prodId.", '1') </script>";
    }
}*/

include "header.php";
include('database.php');
include_once ("Rating.php");
$_SESSION['first'] = 'Y';
/*$prod_id = "";
$prod_cat = "";
$prod_brand = "";
$prod_title = "";
$prod_price = "";
$prod_promo_price = "";
$prod_pic = "";
$categ_name = "";
*/

?>


<!--Categories and Slide-->
<div class="container-fluid row h-100">
    <!--Categories-->
    <div id="categ" class="position-relative overflow-hidden bg-light h-100 text-center text-white p-0 col-3">
        <table class="table table-light table-hover category-table">
            <thread>
                <tr>
                    <th>Categories</th>
                </tr>
            </thread>
            <tbody>
            <?php
            $sql = "SELECT * from categories";
            $result = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($result)) {
                printf("<tr> <td><a href=\"product-categories.php\">%s</a></td></tr>", $rows['cat_title']);
            }
            ?>
            </tbody>
        </table>
    </div>
    <!--end-Category-->

    <!--Slide-->
    <div id="slide" class="position-relative overflow-hidden  text-center bg-light m-0 p-0 w-100  col">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="slide_Img/slide1.PNG" alt="Slide 1" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="slide_Img/slide2.jpg" alt="Slide 2" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="slide_Img/slide3.jpg" alt="Slide 3" width="1100" height="500">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!--end-Slides-->
</div>
<!--end-Categories and Slide-->


<!--Top Sales-->
<div class="section section-bgColor section-shadow ">
    <script>work2()</script>
    <div class="text-center topSales-title">
        <h1 class="ml5">
          <span class="text-wrapper">
                <span class="line line1"></span>
                <span class="letters letters-left">Top</span>
                <span class="letters letters-right">Sales</span>
                <span class="line line2"></span>
          </span>
        </h1>
    </div>

    <!-- row -->
    <div class="row container p-0 m-auto " id="topProd ">
        <!--Top Sales -->
        <?php
        $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id Order by product_quantity Limit 3";
        $result = mysqli_query($conn, $sql);
        $topNo=0;
         while ($row = mysqli_fetch_array($result)){
             $prod_pic = explode(",", $row['product_image']);
             echo " 
                  <a href='product.php?prodID=".$row['product_id']." '>
                    <div class=\"col-4 \">
                         <div class=\"topSales\">
                             <div class=\"topSales-img\">
                                 <img src=\"Admin/Product%20Image/".$prod_pic[0] ."\" alt=\"top sales 1\">
                             </div>
                             <div class=\"topSales-body\">
                                 <h3 class=\"collection\">Top ".++$topNo."<p style='font-size: 18px'>".$row['product_title']."</p></h3>
                                 <a href='product.php?prodID=".$row['product_id']."'>Shop now <i class=\"fa fa-arrow-circle-right\"></i></a>
                             </div>
                         </div>
                    </div>
                 </a>";

         }
        ?>
        <!--end-topSales -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!--end-TopSales-->


<!--Section-->
<section>
    <!--New Product-->
    <div class="newProduct section-shadow bg-light">
        <!--Nav Header-->
        <div class="container-fluid">
            <div class="row">
                <h1 class="col-7">New Products</h1>
                <div class="col-5 ">
                    <ul class="link-effect text-right">
                        <li><a href="product-categories.php">Show More >></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end-Nav Header-->


        <!--Body-->
        <div>
            <div class="items section-shadow ">
                <?php
                $conn = @mysqli_connect($hostname, $username, $password,$database) OR
                die ('Could not connect to MySQL: '.mysqli_connect_error());
                $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id LIMIT 10";
                $result = mysqli_query($conn, $sql);

                //Product Exist
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $prod = getProdDetail($row['product_id']);
                        $prod_pic = explode(",", $prod['image']);

                        $rstar = ratingStar($prod['id']);

                        echo "	
	                    	<div class='product'>
								<a href='product.php?prodID=".$prod['id']." '>
								<div class='product-img'>
									<img src='Admin/Product%20Image/$prod_pic[0]' alt='Product 1'>
									<div class='product-label '>";

                        // Promotion Rate label if have the product have promotion
                        if ($prod['promo_price'] != 0.00) {
                            $prod_rate = round(($prod['price'] - $prod['promo_price']) / $prod['price'] * 100);
                            printf("<span class='sale'>- %d%%</span>", $prod_rate);
                        }
                        echo "
										<span class='new'>NEW</span>
									</div>
								</div>
								<div class='product-body'>
									<p style='font-size: 10px' class='product-category'>".$prod['cat_name']."</p>
									<p style='font-size: 15px;' class='product-name header-cart-item-name'><a href='product.php?prodID=".$prod['id']."'>".$prod['name']."</a></p>";

                        echo ($prod['promo_price'] != 0.00) ?
                            "<h5 class='product-price header-cart-item-info'>RM ".$prod['promo_price']."<del class='product-old-price'>".$prod['price']."</del></h5>" :
                            "<h5 class='product-price header-cart-item-info'>RM ".$prod['price']."</h5>";
                        $prodID = $prod['id'];
                        echo "
                                    	<div class='product-rating'>";

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
                        echo "
									</div></a>
								</div>
								<div class='add-to-cart'>";
                        if(isset($_SESSION['uid'])){ // If user already login
							if($prod['published'] <1){ // If product is out of stock
								 echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick=\"alert('Sorry, This product is out of stock')\"  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
							}else{ // If product in stock
                        	    echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick='SetCookie(\"cart$prodID\", \"1\")'  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
							}
						}else{
                            echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick='openLoginModal()'  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
                        }
						echo "		</div>
							</div>";
                    }
                } else {
                    echo '<div class="error">Database problem! No product found in database</div>';
                }
                ?>
            </div>
        </div>
        <!--end-Body-->
    </div>
    <!--end-New Product-->


    <!--Promotion-->
    <div id="promotion" class="position-relative">
        <div class="position-relative promotion-img">
            <img src="img/bg_img/promotion.jpg" alt="promotion">
        </div>
        <!--Countdown-->
        <div id="countdown">
            <div class=" neonlight">
                <div class="neons col-12">
                    <h1>Flash Sale</h1>
                </div>
            </div>
            <!--countdown time-->
            <ul>
                <li id="t1"></li>
                <li id="t2"></li>
                <li id="t3"></li>
                <li id="t4"></li>
            </ul>
            <!--end-Countdown Time-->
            <button class="btn btn-danger shopNow-btn" onclick="location='product-categories.php'">SHOP NOW</button>
        </div>
        <!--end-Countdown-->
    </div>
    <!--end-Promotion-->


    <!--Category Product-->
    <div class="newProduct section-shadow overflow-hidden bg-light">
        <!--Header-->
        <div class="container-fluid">
            <div style="height: 80px;" id="category"></div>
            <div class="row">
                <h1 class="col-5">Categories</h1>
                <div class="col-7 ">
                    <ul class="link-effect text-right">
                        <?php
                        $sql = "SELECT * from categories";
                        $result = mysqli_query($conn, $sql);
                        while ($rows = mysqli_fetch_assoc($result)) {
                            printf("<li><a href='index.php?categ=%d#category'>%s</a></li>", $rows['cat_id'], $rows['cat_title']);
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>

        <!--end-Header-->

        <div id="category">
            <div class="items section-shadow " id="categOption">
                <?php
                /*Count the quantity of categories type*/
                $categ = "SELECT *FROM categories";
                $run_query = mysqli_query($conn, $categ);

                if (isset($_GET['categ'])) {
                    $categOption = $_GET['categ'];
                    for ($i = 1; $i <= mysqli_num_rows($run_query); $i++) {
                        if ($categOption == $i) {
                            $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id AND cat_id =$i";
                        }
                    }
                } else {
                    $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id  AND cat_id = 1 ";
                }

                $result = mysqli_query($conn, $sql);
                //Product Exist

                if (mysqli_num_rows($result) > 0) {
                    //Get product detail
                    while ($row = mysqli_fetch_array($result)) {
                        $prod = getProdDetail($row['product_id']);
                        $prod_pic = explode(",", $prod['image']);


                        echo "	
	                    	<div class='product'>
								<a href='product.php?prodID=".$prod['id']." '>
								<div class='product-img'>
									<img src='Admin/Product%20Image/$prod_pic[0]' alt='Product 1'>
									<div class='product-label '>";

                        // Promotion Rate label if have the product have promotion
                        if ($prod['promo_price'] != 0.00) {
                            $prod_rate = round(($prod['price'] - $prod['promo_price']) / $prod['price'] * 100);
                            printf("<span class='sale'>- %d%%</span>", $prod_rate);
                        }
                        echo "
										<span class='new'>NEW</span>
									</div>
								</div>
								<div class='product-body'>
									<p style='font-size: 10px' class='product-category'>".$prod['cat_name']."</p>
									<p style='font-size: 15px;' class='product-name header-cart-item-name'><a href='product.php?prodID=".$prod['id']."'>".$prod['name']."</a></h3>";

                        echo ($prod['promo_price'] != 0.00) ?
                            "<h5 class='product-price header-cart-item-info'>RM ".$prod['promo_price']."<del class='product-old-price'>".$prod['price']."</del></h5>" :
                            "<h5 class='product-price header-cart-item-info'>RM ".$prod['price']."</h5>";
                        $prodID = $prod['id'];
                        echo "
                                    <div class='product-rating'>";
                        $rstar = ratingStar($prod['id']);

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
                        echo "
									</div>
								</div></a>
								<div class='add-to-cart'>";
                        if(isset($_SESSION['uid'])){ // If user already login
							if($prod['published'] <1){ // If product is out of stock		
                        	    echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick=\"alert('Sorry, This product is out of stock')\"  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
							}else{ // If product in stock
                        	    echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick='SetCookie(\"cart$prodID\", \"1\")'  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
							}
						}else{
                            echo "<button  class='add-to-cart-btn block2-btn-towishlist' onclick='openLoginModal()'  ><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
                        }
						echo "		</div>
							</div>";
                    }
                } else {
                    echo '<div class="error">Database problem! No product found in database</div>';
                }
                ?>
            </div>
        </div>
        <!--end-Body-->
    </div>
    <!--end-Category Product-->
</section>

<!--end-Section-->


<?php include('footer.php'); ?>
