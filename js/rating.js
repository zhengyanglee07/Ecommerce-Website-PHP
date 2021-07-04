function highlightStar(obj,id) {
    removeHighlight(id);
    $('.ratingAndReview #review-'+id+' li').each(function(index) {
        $(this).addClass('highlight');
        if(index === $('.ratingAndReview #review-'+id+' li').index(obj)) {
            return false;
        }
    });
}

function removeHighlight(id) {
    $('.ratingAndReview #review-'+id+' li').removeClass('selected');
    $('.ratingAndReview #review-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
    $('.ratingAndReview #review-'+id+' li').each(function(index) {
        $(this).addClass('selected');
        $('#review-'+id+' #rating').val((index+1));
        if(index === $('.ratingAndReview #review-'+id+' li').index(obj)) {
            return false;
        }
    });
    $.ajax({
        url: "add_rating.php",
        data:'id='+id+'&rating='+$('#review-'+id+' #rating').val(),
        type: "POST",
        success: function(data) {
            $("#star-rating-count-"+id).html(data);
        }
    });
}

function resetRating(id) {
    if($('#review-'+id+' #rating').val() != 0) {
        $('.ratingAndReview #review-'+id+' li').each(function(index) {
            $(this).addClass('selected');
            if((index+1) == $('#review-'+id+' #rating').val()) {
                return false;
            }
        });
    }
}