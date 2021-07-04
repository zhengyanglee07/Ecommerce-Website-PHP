<?php
include_once('AdminHelper.php');
$categ = trim($_GET['p']);

echo '<td><label for="product" style=" margin-top: 20px; margin-bottom: 50px;">Choose the product : </label></td>';
echo '<option value="">--Select Product--</option>';
if(array_key_exists($categ,$productList))
{
    $product = $productList[$categ];
    
    foreach ($product as $key => $value) {
        echo '<option value="'.$value.'">'.$value.'</option>';
    }
}
echo '</select>';

?>