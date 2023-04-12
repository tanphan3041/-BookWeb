<?php
session_start();
if (!isset($_SESSION['user']))
    header("location: index.php?Message=Đăng nhập để tiếp tục");
include "dbconnect.php";
$customer = $_SESSION['user'];
?>
<?php

if (isset($_GET['place'])) {
    $query = "DELETE FROM cart where Customer='$customer'";
    $result = mysqli_query($con, $query);
?>
    <script type="text/javascript">
        alert("Đơn hàng đã được lưu, hãy giữ liên lạc! Chúng tôi sẽ giao hàng cho đơn vị vận chuyển trong thời gian ngắn nhất!");
    </script>
<?php
}
if (isset($_GET['remove'])) {
    $product = $_GET['remove'];
    $query = "DELETE FROM cart where Customer='$customer' AND Product='$product'";
    $result = mysqli_query($con, $query);
?>
    <script type="text/javascript">
        alert("Sản phẩm đã được xóa khỏi giỏ hàng");
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cart">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="author" content="Shivangi Gupta">
    <title>order</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/test2.css" rel="stylesheet">
    <style>
        #cart {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .panel {
            border: 1px solid #8ccc24d5;
            padding-left: 0px;
            padding-right: 0px;
        }

        .panel-heading {
            background: #8ccc24d5 !important;
            color: white !important;
        }

        #service {
            margin-bottom: 0%;
            margin-top: 310px;
            background: #fff;
            padding: 20px 10px;
            width: 112%;
            margin-left: -6%;
            margin-right: -6%;
        }

        .glyphicon {
            color: #8ccc24d5;
        }

        @media only screen and (width: 767px) {
            body {
                margin-top: 150px;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/pngegg.png" style="width: 55px; margin-left: 50px; margin-top:1px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!isset($_SESSION['user'])) {
                        echo '
	            <li>
	                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Đăng nhập</button>
	                  <div id="login" class="modal fade" role="dialog">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                <h4 class="modal-title text-center">Đăng nhập</h4>
	                            </div>
	                            <div class="modal-body">
	                              <ul >
	                                <li>
	                                  <div class="row">
	                                      <div class="col-md-12 text-center">
	                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
	                                              <div class="form-group">
	                                                  <label class="sr-only" for="username">Username</label>
	                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
	                                              </div>
	                                              <div class="form-group">
	                                                  <label class="sr-only" for="password">Password</label>
	                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
	                                                  <div class="help-block text-right">
	                                                      <a href="#">Forget the password ?</a>
	                                                  </div>
	                                              </div>
	                                              <div class="form-group">
	                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
	                                                      Đăng nhập
	                                                  </button>
	                                              </div>
	                                          </form>
	                                      </div>
	                                  </div>
	                                </li>
	                              </ul>
	                            </div>
	                            <div class="modal-footer">
	                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	                            </div>
	                        </div>
	                    </div>
	                  </div>
	            </li>
	            <li>
	              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Đăng ký</button>
	                <div id="register" class="modal fade" role="dialog">
	                  <div class="modal-dialog">
	                      <div class="modal-content">
	                          <div class="modal-header">
	                              <button type="button" class="close" data-dismiss="modal">&times;</button>
	                              <h4 class="modal-title text-center">Đăng ký tài khoản</h4>
	                          </div>
	                          <div class="modal-body">
	                            <ul >
	                              <li>
	                                <div class="row">
	                                    <div class="col-md-12 text-center">
	                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
	                                            <div class="form-group">
	                                                <label class="sr-only" for="username">Username</label>
	                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
	                                            </div>
	                                            <div class="form-group">
	                                                <label class="sr-only" for="password">Password</label>
	                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
	                                            </div>
	                                            <div class="form-group">
	                                                <button type="submit" name="submit" value="register" class="btn btn-block">
	                                                    Đăng ký
	                                                </button>
	                                            </div>
	                                        </form>
	                                    </div>
	                                </div>
	                              </li>
	                            </ul>
	                          </div>
	                          <div class="modal-footer">
	                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	                          </div>
	                      </div>
	                  </div>
	                </div>
	            </li>';
                    } else
                        echo ' <li> <a href="destroy.php" class="btn btn-lg"><span class="glyphicon glyphicon-log-out"></span> </a> </li>';
                    ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div id="top">
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" method="POST" action="Result.php">
                    <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Tìm kiếm theo tên Sách, tên Tác giả hoặc Thể loại.">
                </form>
            </div>
        </div>


        <?php

        echo '<div class="container-fluid" id="cart">
      <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h2 style="color:#8ccc24d5;text-transform:uppercase;">  GIỎ HÀNG </h2>
           </div>
        </div>';
        if (isset($_SESSION['user'])) {
            if (isset($_GET['ID'])) {
                $product = $_GET['ID'];
                $quantity = $_GET['quantity'];
                $query = "SELECT * from cart where Customer='$customer' AND Product='$product'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) == 0) {
                    $query = "INSERT INTO cart values('$customer','$product','$quantity')";
                    $result = mysqli_query($con, $query);
                } else {
                    $new = $_GET['quantity'];
                    $query = "UPDATE `cart` SET Quantity=$new WHERE Customer='$customer' AND Product='$product'";
                    $result = mysqli_query($con, $query);
                }
            }
            $query = "SELECT PID,Title,Author,Edition,Quantity,Price FROM cart INNER JOIN products ON cart.Product=products.PID 
              	        WHERE Customer='$customer'";
            $result = mysqli_query($con, $query);
            $total = 0;
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                $j = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $path = "img/books/" . $row['PID'] . ".jpg";
                    $Stotal = $row['Quantity'] * $row['Price'];
                    if ($i % 2 == 1)  $offset = 1;
                    if ($i % 2 == 0)  $offset = 2;
                    if ($j % 2 == 0)
                        echo '<div class="row">';
                    echo '                
                                      <div class="panel col-xs-12 col-sm-4 col-sm-offset-' . $offset . ' col-md-4 col-md-offset-' . $offset . ' col-lg-4 col-lg-offset-' . $offset . ' text-center" style="color:#0d6e1d;font-weight:800;">
                                          <div class="panel-heading">Đơng hàng ' . $i . '
                                          </div>
                                          <div class="panel-body">
			                                                <img class="image-responsive block-center" src="' . $path . '" style="height :100px;"> <br>
           							                                               Tên sách : ' . $row['Title'] . '  <br> 
                                                                        Mã sản phẩm : ' . $row['PID'] . '     <br>        	 
                                                      									Tác giả : ' . $row['Author'] . ' <br>                            	      
                                                      									Tái bản : ' . $row['Edition'] . ' <br>
                                                      									Số lượng : ' . $row['Quantity'] . ' <br>
                                                      									Giá : ' . $row['Price'] . ' đ<br>
                                                      									Tổng : ' . $Stotal . ' đ<br>
                                                                       <a href="cart.php?remove=' . $row['PID'] . '" class="btn btn-sm" 
                                                                          style="background:#8ccc24d5;color:white;font-weight:800;">
                                                                          Xóa
                                                                        </a>
                                        </div>
                                    </div>';
                    if ($j % 2 == 1)
                        echo '</div>';
                    $total = $total + $Stotal;
                    $i++;
                    $j++;
                }

                echo '<div class="container">
                              <div class="row">  
                                 <div class="panel col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center" style="color:#0d6e1d;font-weight:800;">
                                     <div class="panel-heading">TỔNG ĐƠN HÀNG
                                     </div>
                                      <div class="panel-body">' . $total . ' đ
                                     </div>
                                 </div>
                               </div>
                          </div>
                         ';
                echo '<br> <br>';
                echo '<div class="row">
                             <div class="col-xs-8 col-xs-offset-3  col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3">
                                  <a href="index.php" class="btn btn-lg" style="background:#8ccc24d5;color:white;font-weight:800;">Tiếp tục mua sắm</a>
                             </div>
                             <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-1 col-lg-4 ">
                                  <a href="cart.php?place=true" class="btn btn-lg" style="background:#8ccc24d5;color:white;font-weight:800;margin-top:5px;">Đặt hàng</a>
                             </div>
                           </div>
                           ';
            } else {
                echo ' 
                         <div class="row">
                             <div class="col-xs-9 col-xs-offset-3 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
                                  <a href="index.php" class="btn btn-lg" style="background:#8ccc24d5;color:white;font-weight:800;">Tiến hành mua sắm</a>
                             </div>
                          </div>';
            }
        } else {
            echo "Đăng nhập để tiếp tục";
        }
        echo '</div>';
        ?>

        <div class="container-fluid" id="service">
            <div class="row">
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-heart"></span> <br>
                    24/7 <br>
                    Hỗ trợ 24/7, hãy liên lạc vào số điện thoại 0367700679.
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-ok"></span> <br>
                    An toàn <br>
                    Đảm bảo trả sản phẩm và hoàn tiền trong điều kiện hợp lý.
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-send"></span> <br>
                    Nhanh chóng <br>
                    Cửa hàng của chúng tôi hỗ trợ ship COD giao hàng tận nơi.
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-book"></span> <br>
                    Bảo vệ sách <br>
                    Sản phẩm của bạn sẽ được đóng gói cẩn thận với màng bọc bên trong và chống sốc bên ngoài.
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
</body>

<html>