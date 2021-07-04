<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="dashboard/dashboard.css"/>
    <title>Header</title>
  </head>
  <body>
      
       <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
           <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-5" href="Admin_Order.php" style="font-size: 20px; font-weight: 500;">Noble Phoenix Admin</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li>
                    <div data-toggle="dropdown">
                        <?php 
                                           
                            include_once('AdminHelper.php');
                            
                            $sql = "SELECT *FROM rating";

                            $result = mysqli_query($con, $sql);
                            $count=0;
                            while($row = mysqli_fetch_array($result))
                            {
                                $count=+$count;
                                $count++;
                                if($count > 99)
                                {
                                    $count = "99+";
                                }
                            }
                            printf('<a class="nav-link" href="#"><span data-feather="bell" style=" width: 25; height: 25;"></span><b style="background-color: red; color: white; border-radius: 50px;">%d</b></a>',$count);
                        ?>
                        
                    </div>
                </li>
                <li class="nav-item text-nowrap">
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php
         
                            $sql = "SELECT *FROM rating";

                            $result = mysqli_query($con, $sql);
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                printf('<a class="dropdown-item">The Customer give our %d star</a>',$row['rating']);
                            }
                        ?>
                    </div>
                </li>
                <li>
                    <div class="dropdown position-relative">
        <div data-toggle="dropdown" >
            <a href="#"><img src="image/admin logo3.0.png" style=" border-radius: 50%; width: 45px; height: 45px; display: block; border: solid black 1px;"></a>
        </div>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="../index.php">Log Out</a>
        </div>
      </div>
                    
                </li>
                                    

            </ul> 
        </nav>
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard/dashboard.js"></script></body>
</html>