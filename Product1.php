<?php
session_start();
// if (!isset($_SESSION['user']))
//    header("location: index.php?Message=Đăng nhập để tiếp tục");
?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="Books">
   <meta name="author" content="Shivangi Gupta">
   <title>Online Bookstore</title>
   <!-- Bootstrap -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/test2.css" rel="stylesheet">

   <style>
      #books {
         margin-bottom: 50px;
      }

      @media only screen and (width: 767px) {
         body {
            margin-top: 150px;
         }
      }

      #books .row {
         margin-top: 20px;
         margin-bottom: 10px;
         font-weight: 800;
      }

      @media only screen and (max-width: 760px) {
         #books .row {
            margin-top: 10px;
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
            <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/pngegg.png" style="width: 55px; margin-left: 36px; margin-top: -13px;"></a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
               <?php
               if (isset($_SESSION['user'])) {
                  echo '
                    <li><a href="cart.php" class="btn btn-lg"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                    <li><a href="destroy.php" class="btn btn-lg"> <span class="glyphicon glyphicon-log-out"></span></a></li>
                         ';
               }
               ?>
            </ul>
         </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
   </nav>

   <div id="top">
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
         <div>
            <form role="search" action="Result.php" method="post">
               <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo tên sách, tên Tác giả hoặc Thể loại." style="width:80%;margin:20px 10% 20px 10%;">
            </form>
         </div>
      </div>



      <?php
      include "dbconnect.php";
      if (isset($_GET['value1'])) {
         $_SESSION['publisher'] = $_GET['value1'];
      }
      $publisher = $_SESSION['publisher'];
      if (isset($_POST['sort'])) {
         if ($_POST['sort'] == "price") {
            $query = "SELECT * FROM products WHERE Publisher='$publisher' ORDER BY Price";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
      ?>
            <script type="text/javascript">
               document.getElementById('select').Selected = $_POST['sort'];
            </script>
      <?php
         } else
        if ($_POST['sort'] == "priceh") {
            $query = "SELECT * FROM products WHERE Publisher='$publisher' ORDER BY Price DESC";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
         } else
        if ($_POST['sort'] == "discount") {
            $query = "SELECT * FROM products WHERE Publisher='$publisher' ORDER BY Discount DESC";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
         } else
        if ($_POST['sort'] == "discountl") {
            $query = "SELECT * FROM products WHERE Publisher='$publisher' ORDER BY Discount";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
         }
      } else {
         $query = "SELECT * FROM products WHERE Publisher='$publisher'";
         $result = mysqli_query($con, $query) or die(mysqli_error($con));
      }
      $i = 0;
      echo '<div class="container-fluid" id="books">
        <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h2 style="color:#0d6e1d;text-transform:uppercase;margin-bottom:0px;"> Sách của NXB ' . $publisher . '</h2>
           </div>
        </div>      
        <div class="container fluid">
             <div class="row">
                  <div class="col-sm-5 col-sm-offset-6 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8">
                       <form action="';
      echo $_SERVER['PHP_SELF'];
      echo '" method="post" class="pull-right">
                           <label for="sort">Sắp xếp &nbsp: &nbsp</label>
                            <select name="sort" id="select" onchange="form.submit()">
                                <option value="default" name="default"  selected="selected">Chọn</option>
                                <option value="price" name="price">Giá từ thấp đến cao </option>
                                <option value="priceh" name="priceh">Giá từ cao đến thấp </option>
                                <option value="discountl" name="discountl">Sale ít </option>
                                <option value="discount" name="discount">Sale nhiều </option>
                            </select>
                       </form>
                  </div>
              </div>
        </div>';

      if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
            $path = "img/books/" . $row['PID'] . ".jpg";
            $description = "description.php?ID=" . $row["PID"];
            if ($i % 4 == 0)
               echo '<div class="row">';
            echo '
               <a href="' . $description . '">
                <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                    <div class="book-block" style="border :3px solid #DEEAEE;">
                        <img class="book block-center img-responsive" src="' . $path . '">
                        <hr>
                         ' . $row["Title"] . '<br>
                        ' . $row["Price"] . '  &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> ' . $row["MRP"] . ' </span>
                        <span class="label label-warning">' . $row["Discount"] . '%</span>
                    </div>
                </div>
                
               </a> ';
            $i++;
            if ($i % 4 == 0)
               echo '</div>';
         }
      }
      echo '</div>';
      ?>



      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
</body>

</html>
<!--	
<script>
$('#my_select').change(function() {   
   // assign the value to a variable, so you can test to see if it is working
    var selectVal = $('#my_select :selected').val();
    alert(selectVal);
});
</script>

-->