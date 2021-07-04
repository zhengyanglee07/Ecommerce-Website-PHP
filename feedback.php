<?php
$PAGE_TITLE = "FeedBack";
include('header.php');
?>


<div class="section section-bgColor section-shadow position-relative">
    <!--Title-->
    <hr style="border: 2px solid darkgrey">
    <h3 style="display: inline-block; font-weight: bold">Noble Phoenix</h3><span> online shop</span>
    <hr style="border: 2px solid darkgrey">
    <!--end-Title-->

    <div class="row">
        <!--Company Information-->
        <div class="container-fluid col text-left ">
            <ul class="company-info">
                <li>Address : <p>LotA-10, 1st floor, Block A, Grand Plaza, 48000,Selangor</p></li>


                <li>Office Number : <span>03-6091-3256</span></li>
                <li>Hotline Number : <span>03-6091-4568</span></li>

                <li>Email : <span>noblephoenix.gmail.com</span></li>
            </ul>

        </div >
        <!--end-Company Information-->

        <!--Feedback Form-->
        <div class="col feedbackForm">
            <div class="container feedback">
                <h1 style="font-weight: 600; color: blue;text-align: center">Feedback</h1>
                <hr style="border: 2px solid darkcyan">
                <form class="" >
                    <p>Name</p>
                    <input class="feedback-name" style="margin-right: 15px;" type="text" placeholder="first name">
                    <input class="feedback-name" type="text" placeholder="last name">

                    <p>Email</p>
                    <input style="width: 100%" type="email">

                    <p>Comment or Message</p>
                    <textarea style="width: 100%; height: 150px;" ></textarea><br>

                    <input style="width: 100%" type="submit" class="btn btn-primary" value="Submit">
                </form>

            </div>
        </div>
        <!--end-FeedBack Form-->
    </div>

</div>


<?php include('footer.php'); ?>
