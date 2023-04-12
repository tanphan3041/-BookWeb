<?php
session_start();
require_once "admin-log.php";
require_once "./header.php";
$title = "Add new book";
require "./func/db_func.php";
$con = db_connect();

if (isset($_POST['add'])) {
   $PID = trim($_POST['PID']);
   $PID = mysqli_real_escape_string($con, $PID);

   $Title = trim($_POST['Title']);
   $Title = mysqli_real_escape_string($con, $Title);

   $Author = trim($_POST['Author']);
   $Author = mysqli_real_escape_string($con, $Author);

   $MRP = floatval(trim($_POST['MRP']));
   $MRP = mysqli_real_escape_string($con, $MRP);

   $Price = floatval(trim($_POST['Price']));
   $Price = mysqli_real_escape_string($con, $Price);

   $Discount = floatval(trim($_POST['Discount']));
   $Discount = mysqli_real_escape_string($con, $Discount);

   $Available = floatval(trim($_POST['Available']));
   $Available = mysqli_real_escape_string($con, $Available);

   $Publisher = trim($_POST['Publisher']);
   $Publisher = mysqli_real_escape_string($con, $Publisher);

   $Edition = floatval(trim($_POST['Edition']));
   $Edition = mysqli_real_escape_string($con, $Edition);

   $Category = trim($_POST['Category']);
   $Category = mysqli_real_escape_string($con, $Category);

   $Description = trim($_POST['Description']);
   $Description = mysqli_real_escape_string($con, $Description);

   $Language = trim($_POST['Language']);
   $Language = mysqli_real_escape_string($con, $Language);

   $page = floatval(trim($_POST['page']));
   $page = mysqli_real_escape_string($con, $page);

   $weight = floatval(trim($_POST['weight']));
   $weight = mysqli_real_escape_string($con, $weight);


   // add image
   if (isset($_FILES['Image']) && $_FILES['Image']['name'] != "") {
      $Image = $_FILES['Image']['name'];
      $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
      $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "img/books/";
      $uploadDirectory .= $Image;
      move_uploaded_file($_FILES['Image']['tmp_name'], $uploadDirectory);
   }


   $query = "INSERT INTO products VALUES ('" . $PID . "'
                                       , '" . $Title . "'
                                       , '" . $Author . "'
                                       , '" . $Image . "'
                                       , '" . $MRP . "'
                                       , '" . $Price . "'
                                       , '" . $Discount . "'
                                       , '" . $Available . "'
                                       , '" . $Publisher . "'
                                       , '" . $Edition . "'
                                       , '" . $Category . "'
                                       , '" . $Description . "'
                                       , '" . $Language . "'
                                       , '" . $page . "'
                                       , '" . $weight . "')";
   $result = mysqli_query($con, $query);
?>
   <script type="text/javascript">
      alert("Sách đã được thêm!");
   </script>
   <?php
   if (!$result) {
   ?>
      <script type="text/javascript">
         alert("Không thể thêm sách, vui lòng kiểm tra lại thông tin!");
      </script>
<?php
      exit;
   }
}
?>

<form method="post" action="add.php" enctype="multipart/form-data">
   <table class="table">
      <tr>
         <th>Mã sách</th>
         <td><input type="text" name="PID"></td>
      </tr>
      <tr>
         <th>Tên sách</th>
         <td><input type="text" name="Title" required></td>
      </tr>
      <tr>
         <th>Tác giả</th>
         <td><input type="text" name="Author" required></td>
      </tr>
      <tr>
         <th>Hình</th>
         <td><input type="file" name="Image" required> </td>
      </tr>
      <tr>
         <th>Giá sale</th>
         <td><input type="text" name="MRP" required></td>
      </tr>
      <tr>
         <th>Giá</th>
         <td><input type="text" name="Price" required></td>
      </tr>
      <tr>
         <th>Sale</th>
         <td><input type="text" name="Discount" required></td>
      </tr>
      <tr>
         <th>Số lượng</th>
         <td><input type="text" name="Available" required></td>
      </tr>
      <tr>
         <th>NXB</th>
         <td><input type="text" name="Publisher" required></td>
      </tr>
      <tr>
         <th>Tái bản</th>
         <td><input type="text" name="Edition" required></td>
      </tr>
      <tr>
         <th>Thể loại</th>
         <td><input type="text" name="Category" required></td>
      </tr>
      <tr>
         <th>Thông tin</th>
         <td><textarea name="Description" cols="80" rows="10"></textarea></td>
      </tr>
      <tr>
         <th>Ngôn ngữ</th>
         <td><input type="text" name="Language" required></td>
      </tr>
      <tr>
         <th>Số trang</th>
         <td><input type="text" name="page" required></td>
      </tr>
      <tr>
         <th>Trọng lượng</th>
         <td><input type="text" name="weight" required></td>
      </tr>
   </table>
   <input type="submit" name="add" value="Thêm sách" class="btn btn-primary">
   <input type="reset" value="Hủy" class="btn btn-default">
</form>
<br />
<?php
if (isset($con)) {
   mysqli_close($con);
}
?>