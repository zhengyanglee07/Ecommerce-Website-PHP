<?php

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASSWORD','');
define('DB_NAME','noblephoenix');

$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to SQL : '. mysqli_connect_error());       

function validationProdName($ProductName){
    
    if($ProductName == null){
        return 'The <strong>Product Name</strong> cannot be blank!';
    }

}

function validationBrand($ProductBrand){
    
    if($ProductBrand == null){
        return 'The <strong>Product Brand</strong> cannot be blank!';
    }

}

function validationDesc($DescriptionProd){
    
    if($DescriptionProd == null){
        return 'The <strong>Product Description</strong> cannot be blank!';
    }
}

function validationImage($UploadProduct){
    $error=null;
    
    if($UploadProduct['error']>0) //means have upload error.
                                {
                                    switch ($UploadProduct['error'])
                                    {
                                        case UPLOAD_ERR_NO_FILE:
                                           $error = 'The <strong>Product Image</strong> cannot be blank!';
                                            break;
                                        case UPLOAD_ERR_FORM_SIZE:
                                            $error = 'The <strong>Product Image</strong> uploaded is too large. Maximum file size is 1MB allowed.';
                                            break;
                                        default:
                                            $error = 'There was an error while uploading the <strong>Product Image</strong>.';
                                            break;
                                    }
                                }
                                else if($UploadProduct['size'] > 1048576)
                                {
                                    $error = 'The <strong>Product Image</strong> uploaded is too large. Maximum file size is 1MB allowed.';
                                }
                                else 
                                {
                                    //get the file extension
                                    $ext = strtolower(pathinfo($UploadProduct['name'],PATHINFO_EXTENSION));

                                    //check file extension 
                                    if($ext != 'jpg' && $ext != 'png' && $ext != 'gif')
                                    {
                                        $error ='Only <strong>JPG, GIF, PNG</strong> file format is allowed.';
                                    }
                                    else
                                    {
                                        //everything is ok
                                        $save_asName = uniqid() . '.' . $ext;

                                        //move the file
                                        move_uploaded_file($UploadProduct['tmp_name'], 'Product Image/' . $save_asName);

                                    }
                                    
                                    
                                }
                                if(!empty($error))
                                {
                                    return $error;
                                }
                                else{
                                    return $save_asName;
                                }
}

function validationPrice($price){
    if($price == null){
        return 'The <strong>Product Price</strong> cannot be blank!';
    }
    else if(preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $price)){
        return 'The <strong>Product Price</strong> can put digit only!';   
    }
    
}

function validationQuantity($quantity){
    if($quantity == null){
        return 'The <strong>Product Quantity</strong> cannot be blank!';
    }
}

function validationCategory($category){
    if($category == null){
        return 'Please select a <strong>Category</strong>';
    }
}

function validationKeyword($keyword){
    if($keyword == null){
        return 'The <strong>Product Keyword</strong> cannot be blank!';
    }
}

function validationOrderStatusTitle($orderStatus){

    if($orderStatus == "CF"){
        return 'Comfirmed';
    }
    else if($orderStatus == "CT"){
        return 'Completed';
    }
    else if($orderStatus == "CC"){
        return 'Cancelled';
    }
}

function validationOrderStatusStyle($orderStatus){

    if($orderStatus == "CF"){
        return 'success';
    }
    else if($orderStatus == "CT"){
        return 'light';
    }
    else if($orderStatus == "CC"){
        return 'danger';
    }
}

function validationPaymentStatus($paymentStatus){
    
    if($paymentStatus == "UP"){
        return 'Unpaid';
    }
    else if($paymentStatus == "FD"){
        return 'Failed';
    }
    else if($paymentStatus == "EP"){
        return 'Expired';
    }
    else if($paymentStatus == "PD"){
        return 'Paid';
    }
    else if($paymentStatus == "RG"){
        return 'Refunding';
    }
    else if($paymentStatus == "RD"){
        return 'Refunded';
    }
}

function validationPaymentStyle($paymentStatus){
    
    if($paymentStatus == "UP"){
        return 'warning';
    }
    else if($paymentStatus == "FD"){
        return 'danger';
    }
    else if($paymentStatus == "EP"){
        return 'light';
    }
    else if($paymentStatus == "PD"){
        return 'success';
    }
    else if($paymentStatus == "RG"){
        return 'primary';
    }
    else if($paymentStatus == "RD"){
        return 'primary';
    }
}

function validationDeliveryStatus($deliveryStatus){
    
    if($deliveryStatus == "UF"){
        return 'Unfulfilled';
    }
    else if($deliveryStatus == "SG"){
        return 'Shipping';
    }
    else if($deliveryStatus == "SD"){
        return 'Shipped';
    }
    else if($deliveryStatus == "AD"){
        return 'Arrived';
    }
    else if($deliveryStatus == "CL"){
        return 'Colleted';
    }
    else if($deliveryStatus == "RG"){
        return 'Returning';
    }
    else if($deliveryStatus == "RD"){
        return 'Returned';
    }
}

function validationDeliveryStyle($deliveryStatus){
    
    if($deliveryStatus == "UF"){
        return 'warning';
    }
    else if($deliveryStatus == "SG"){
        return 'light';
    }
    else if($deliveryStatus == "SD"){
        return 'light';
    }
    else if($deliveryStatus == "AD"){
        return 'light';
    }
    else if($deliveryStatus == "CL"){
        return 'light';
    }
    else if($deliveryStatus == "RG"){
        return 'primary';
    }
    else if($deliveryStatus == "RD"){
        return 'primary';
    }
}

function changeCatProdToInt($category, $product){
    
    if($category == "CleanEA")
    {
        if($product == "Dryers")
            return '10001'; 
        else if($product == "Irons")
            return '10002';
        else if($product == "Vaccum Cleaners")
            return '10003';
        else if($product == "Washing Machine")
            return '10004';
    }
    else if($category == "KitchenA")
    {
        if($product == "Cooking")
            return '20001';
        else if($product == "Dish Washer")
            return '20002';
        else if($product == "Food Maker Cleaners")
            return '20003';
        else if($product == "Mircrowave oven")
            return '20004';
        else if($product == "Rice Cooker")
            return '20005';
    }
    else if($category == "RefrigenerationA")
    {
        if($product == "Cooler")
            return '30001';
        else if($product == "Freezer")
            return '30002';
        else if($product == "Refrigerator")
            return '30003';
    }
    else if($category == "AudioVisualA")
    {
        if($product == "TV")
            return '40001';
        else if($product == "Speaker")
            return '40002';
        else if($product == "Projector")
            return '40003';
    }
    else if($category == "AirC")
    {
        if($product == "Electrical Fan")
            return '50001';
        else if($product == "AirCond")
            return '50002';
    }
}

$productList = array(
    "CleanEA" => "Clean Electrical Applicances",
    "KitchenA" => "Kitchen Appliances",
    "RefrigenerationA" => "Refrigeneration Appliances",
    "AudioVisualA" => "Audio-Visual Appliances",
    "AirC" => "Air Conditioner"
    );


?>