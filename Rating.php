<?php
require_once "helpher.php";

function ratingStar($prodId){
    $rate = getAllPost($prodId);
    $cnt = 0;
    $average=0;
    $avg= 0;
    if(is_array($rate)) {
        foreach ($rate as $review) {
            if (!empty($review["rating_total"])) {
                $average += round(($review["rating_total"] / $review["rating_count"]), 1);
                $cnt++;
            }
        }
        $avg = round($average/$cnt);
    }
    return $avg;
}

function getTotalRating($prodID, $r_star)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM product_review PV, rating R WHERE PV.id = R.review_id AND PV.product_id = '$prodID' AND R.rating = '$r_star' ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

function getAllPost($prodID){
    $query = "SELECT product_review.*, COUNT(rating.rating) as rating_count, SUM(rating.rating) as rating_total FROM product_review LEFT JOIN rating ON product_review.id = rating.review_id WHERE product_id = '$prodID' GROUP BY rating.review_id";

    $postResult = getDBResult($query);
    return $postResult;
}

function getRatingByReview($review_id)
{
    $query = "SELECT product_review.*, COUNT(rating.rating) as rating_count, SUM(rating.rating) as rating_total FROM product_review LEFT JOIN rating ON product_review.id = rating.review_id WHERE rating.review_id = ? GROUP BY rating.review_id";

    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $review_id
        )
    );

    $postResult = getDBResult($query, $params);
    return $postResult;
}

function getRating($review_id, $user_id)
{
    $query = "SELECT * FROM rating WHERE review_id = ? AND user_id = ?";

    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $review_id
        ),
        array(
            "param_type" => "i",
            "param_value" => $user_id
        )
    );

    $ratingResult = getDBResult($query, $params);
    return $ratingResult;
}

function addRating($review_id, $rating, $user_id)
{
    $query = "INSERT INTO rating (review_id,rating,user_id) VALUES (?, ?, ?)";

    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $review_id
        ),
        array(
            "param_type" => "i",
            "param_value" => $rating
        ),
        array(
            "param_type" => "i",
            "param_value" => $user_id
        )
    );

    updateDB($query, $params);
}

function updateRating($rating, $rating_id)
{
    $query = "UPDATE rating SET  rating = ? WHERE id= ?";

    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $rating
        ),
        array(
            "param_type" => "i",
            "param_value" => $rating_id
        )
    );
    updateDB($query, $params);
}

