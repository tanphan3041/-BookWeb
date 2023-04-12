<?php

$title = "List book";
require_once "admin-log.php";
require_once "./header.php";
require_once "./func/db_func.php";
$con = db_connect();
$result = getAll($con);
?>

<p class="lead"><a href="add.php">Thêm sách mới</a></p>
<table class="table" style="margin-top: 20px">
   <tr>
      <th>Mã</th>
      <th>Tên</th>
      <th>Tác giả</th>
      <th>Hình</th>
      <th>Giá sale</th>
      <th>Giá</th>
      <th>Sale</th>
      <th>Số lượng</th>
      <th>NXB</th>
      <th>Tái bản</th>
      <th>Thể loại</th>
      <th>Thông tin</th>
      <th>Ngôn ngữ</th>
      <th>Số trang</th>
      <th>Cân nặng</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
   </tr>
   <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
         <td><?php echo $row['PID']; ?></td>
         <td><?php echo $row['Title']; ?></td>
         <td><?php echo $row['Author']; ?></td>
         <td><?php $path = "img/books/" . $row['PID'] . ".jpg";
               echo '<img class="book block-center img-responsive" width="150px" height="320px" src="' . $path . '">' ?></td>
         <td><?php echo $row['Price']; ?></td>
         <td><?php echo $row['MRP']; ?></td>
         <td><?php echo $row['Discount']; ?></td>
         <td><?php echo $row['Available']; ?></td>
         <td><?php echo $row['Publisher']; ?></td>
         <td><?php echo $row['Edition']; ?></td>
         <td><?php echo $row['Category']; ?></td>
         <td><?php echo mb_strimwidth($row['Description'], 0, 80, "..."); ?></td>
         <td><?php echo $row['Language']; ?></td>
         <td><?php echo $row['page']; ?></td>
         <td><?php echo $row['weight']; ?></td>

         <td class="change-bk"><a href="edit.php?PID=<?php echo $row['PID']; ?>">Sửa</a></td>
         <td class="delete-bk"><a href="delete.php?PID=<?php echo $row['PID']; ?>">Xóa</a></td>
      </tr>
   <?php } ?>
</table>

<?php
if (isset($con)) {
   mysqli_close($con);
}
?>