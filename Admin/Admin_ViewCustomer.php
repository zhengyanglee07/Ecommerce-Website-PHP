<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Order Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">

    </head>
    <body>
        <?php require_once('header.php');?>

       <div class="container-fluid" style=" margin-top: 50px;">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li>
                                <a>
                                    <img src="image/logo.png" style="width: 150px; height: 150px;"/>
                                    <span style=" color:">Noble Phoenix</span>
                                </a>
                           
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Order.php">
                                    <span data-feather="file"></span>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Admin_ProductList.php">
                                    <span data-feather="shopping-cart"></span>
                                    Products<span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Customer.php">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="bar-chart-2"></span>
                                    Reports
                                </a>
                            </li>
                        </ul>

                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Saved reports</span>
                            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Current month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Last quarter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Social engagement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>  
                                    Year-end sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h1"><i data-feather="shopping-cart" style=" width: 45px; height: 45px; margin-left: 10px; margin-right: 20px; margin-top: 20px;"></i>Product</h1>

                    </div>

                    <h2 style=" margin-top: 2em;">Product View</h2>
                    <div style="font-size: 1.2em; font-family: cursive; margin-top: 35px;" border='0' cellpadding='10' cellspacing='0'>
                        <form action="" method="post">
                            <table style="display: block; margin: 20px auto 20px auto; border: solid black 1px; padding: 2%">
                                <tr>
                                    <td><a><img src="image/example.png" style="width: 100px; height: 100px; border: solid black 1px;"></a></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductCode" style=" margin-top: 20px;">Product Code : </label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductName" style=" margin-top: 20px;">Product Name : </label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="DescriptionProd" style=" margin-top: 20px;">Description of Product : </label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="price" style=" margin-top: 20px;">Price (RM) : </label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="quantity" style=" margin-top: 20px;">Quantity :</label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="discount" style=" margin-top: 20px;">Discount (%): </label></td>
                                    <td><a>XXX</a></td>
                                </tr>
                                <tr>
                                    <td><label for="category" style=" margin-top: 45px; margin-bottom: 50px;">Choose the type of the product : </label></td>
                                    <td><a>XXX</a></td>
                                </tr>

                            </table>
                            
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard/dashboard.js"></script></body>
</html>