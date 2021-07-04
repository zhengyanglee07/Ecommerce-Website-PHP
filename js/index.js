/*--------------------Countdown------------------------*/
// Set the date we're counting down to
var countDownDate = new Date("Sep 9, 2020 16:42:59").getTime();

// Update the count down every 1 second
var x = setInterval(function () {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById('t1').innerHTML = days + "d";
    document.getElementById('t2').innerHTML = hours + "h";
    document.getElementById('t3').innerHTML = minutes + "m";
    document.getElementById('t4').innerHTML = seconds + "s";
    /*    document.getElementById("timer").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";*/

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "EXPIRED";
    }
}, 1000);


/*-------------------Slicky Product------------------*/
/*
$(document).ready(function(){

    $('.items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
    });
});
*/

/*----------------Auto Slicky-Product---------------*/
$(document).ready(function () {

    $('.items').slick({
        /*dots: true,*/
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
});


