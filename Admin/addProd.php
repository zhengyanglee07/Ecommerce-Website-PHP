<?php
include('AdminHelper.php');


/*
$imageGet = "SELECT * FROM PRODUCTS WHERE product_id = 84";
$run_query = mysqli_query($conn, $imageGet);

$row = mysqli_fetch_assoc($run_query);

print_r(explode(",", $row['product_image']));
$prod_pic = explode(",", $row['product_image']);



echo "<img src='img/product-img/$prod_pic[0]' alt='Product 1' >";
echo "<img src='img/product-img/$prod_pic[1]' alt='Product 2' >";
echo "<img src='img/product-img/$prod_pic[2]' alt='Product 3' >";
echo "<img src='img/product-img/$prod_pic[3]' alt='Product 4' >";
*/


if (isset($_POST['btn_save'])) {
    $product_name = $_POST['product_name'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $promo_price = $_POST['promo_price'];
    $product_qty = $_POST['product_quantity'];
    $product_type = $_POST['product_type'];
    $brand = $_POST['brand'];
    $keyWord = $_POST['keyWord'];


    /*count the quantity of image uploaded*/
    $totalPIC = count($_FILES['picture']['name']);

    for($i=0; $i <$totalPIC; $i++){
        //picture coding
        $picture_name = $_FILES['picture']['name'][$i];
        $picture_type = $_FILES['picture']['type'][$i];
        $picture_tmp_name = $_FILES['picture']['tmp_name'][$i];
        $picture_size = $_FILES['picture']['size'][$i];


        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
            if ($picture_size <= 50000000) {
                //change the picture name start with the date
                $pic_name[$i] = date("Y-m-d") . "_" . $picture_name;
                /*------------------------------------------------看你是save去哪里XD*/
                move_uploaded_file($picture_tmp_name, "img/product-img/" . $pic_name[$i]);

            } else
                echo '<div class="error">* Picture Size is to large</div>';
        } else {
            echo '<div class="error">* Picture type are not allowed!</div>';
        }

    }


    $picName = implode(",", $pic_name);
    echo $picName;
    mysqli_query($conn, "insert into products (product_cat, product_brand,product_title,product_price,product_promo_price,product_quantity,product_desc, product_image,product_keywords) values ('$product_type','$brand','$product_name','$price','$promo_price','$product_qty','$details','$picName','$keyWord')") or die ("query incorrect");
    mysqli_close($conn);
}

?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
            <div class="row">


                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Product</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Title</label>
                                        <input type="text" id="product_name" required name="product_name"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label>
                                        <input type="file" name="picture[]" multiple="multiple" required class="btn btn-fill btn-success"
                                               id="picture">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" cols="80" id="details" required name="details"
                                                  class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="product_quantity" id="quantity">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pricing</label>
                                        <input type="text" id="price" name="price" required class="form-control">

                                    </div>
                                </div>
                                <div>
                                    <label>Promotion</label>
                                    <input type="number" id="promo_rate" name="promo_rate" value=0 onchange="calculateByRate();" required class="form-control">%

                                    <br />
                                    <label for="promo_price">Final Price</label>
                                    <input type="text" id="promo_price" name="promo_price" onchange="calculateByPrice();">
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-md-5">
                <div>
                    <div>
                        <h5 class="title">Categories</h5>
                    </div>
                    <div>

                        <div class="row">

                            <!-如果可以的话用 select option 来选-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <input type="number" id="product_type" name="product_type" required="[1-6]"
                                           class="form-control">
                                </div>
                            </div>

                            <!-如果可以的话用 select option 来选-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Brand</label>
                                    <input type="number" id="brand" name="brand" required class="form-control">
                                </div>
                            </div>


                            <!--Use for search product-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Keywords</label>
                                    <input type="text" id="keyWord" name="keyWord" required class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update
                            Product
                        </button>
                    </div>
                </div>
            </div>

    </div>
    </form>

</div>
</div>

<script>
    function calculateByRate() {
        var price = document.getElementById('price').value;
        var promo_rate = document.getElementById('promo_rate').value;
        document.getElementById('promo_price').value = price - (price *= promo_rate / 100);
    }

    function calculateByPrice(){
        var price = document.getElementById('price').value;
        var promo_price = document.getElementById('promo_price').value;
        document.getElementById('promo_rate').value = (price - promo_price) / price * 100;
    }
</script>