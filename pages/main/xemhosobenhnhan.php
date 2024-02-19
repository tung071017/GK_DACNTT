<?php
$sql_lietke = "SELECT * FROM benhnhan, lichsu, user  WHERE benhnhan.id_benhnhan = lichsu.id_benhnhan AND lichsu.id_user = user.id_user AND lichsu.id_benhnhan = '$_GET[id]' ORDER BY lichsu.id_ls DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);


$sql = "SELECT * FROM benhnhan WHERE id_benhnhan = '$_GET[id]' ";
$qr = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($qr);
?>
<div class="container mt-4">
    <h6 style="text-align: center; text-transform: uppercase; font-weight: bold;">Lịch sử bệnh án:<?php echo $row['hovaten'] ?></h6>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Chẩn đoán</th>
                    <th>Số phòng</th>
                    <th>Số giường</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Phương pháp</th>
                    <th>Quản lí</th>
                    <?php
                    if ($_SESSION['quyenhan'] == 3) {
                    ?>
                    <th>Cập nhập</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query_lietke)) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['chandoan'] ?></td>
                        <td><?php echo $row['sophong'] ?></td>
                        <td><?php echo $row['sogiuong'] ?></td>
                        <td><?php if($row['trangthai']==1){
                            echo "Nhập viện";
                        }else if($row['trangthai']==2){
                            echo "Đã mất";
                        }else{
                            echo "Xuất viện";
                        }?>
                        </td>
                        <td><?php echo $row['thoigian'] ?></td>
                        <td><?php echo $row['phuongphap'] ?></td>
                        <td>
                        <a class="btn btn-warning"
                            href="index.php?quanly=suahoso&id=<?php echo  $row['id_ls'] ?>&idbn=<?php echo $row['id_benhnhan'] ?>">Sửa</a>
                        </td>
                        <?php
                    if ($_SESSION['quyenhan'] == 3) {
                    ?>
                        <td>
                        <a class="btn btn-dark"
                            href="index.php?quanly=capnhap&idbn=<?php echo $row['id_benhnhan'] ?>">Cập nhập</a>
                        </td>
                        <?php
                    }
                    ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
