<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
//print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
                }, function() {
                window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = ""; // หรือรหัสผ่านของคุณ
$database = "workshop_pdo"; // ชื่อฐานข้อมูลที่คุณใช้

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// ดึงข้อมูลใบแจ้งซ่อมจากฐานข้อมูล
// ตรวจสอบว่าใบแจ้งซ่อมของผู้ใช้นี้เป็นอะไร และแสดงข้อมูลใบแจ้งซ่อมทั้งหมดที่เกี่ยวข้อง
// คุณสามารถใช้คำสั่ง SQL เพื่อดึงข้อมูลใบแจ้งซ่อมได้ตามความต้องการของคุณ
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="~/lib/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="~/css/site.css" asp-append-version="true" />
        <link rel="stylesheet" href="~/Word_of_ModJirawut.styles.css" asp-append-version="true" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        

    </head>
    <body>
        <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="main.php">หน้าหลัก</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            โปรเจ็กต์
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ManageProjects.php">จัดการโปรเจ็กต์</a></li>
            <li><a class="dropdown-item" href="DataAnalytics.php">วิเคราะห์การขาย</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          รายการแจ้งซ่อม
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ReportRepair.php">สร้างรายการแจ้งซ่อม</a></li>
            <li><a class="dropdown-item" href="RepairReport2.php">รายงานการแจ้งซ่อม</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          ใบเสนอราคา
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="Quotation.php">สร้างใบเสนอราคา</a></li>
            <li><a class="dropdown-item" href="Quotation2.php">รายงานใบเสนอราคา</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          ใบรายงานการออกปฏิบัติงานหน้างาน
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="OnsiteWork.php">สร้างใบรายงานการออกปฏิบัติงานหน้างาน</a></li>
            <li><a class="dropdown-item" href="OnsiteWork2.php">รายงานใบรายงานการออกปฏิบัติงานหน้างาน</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="about.php">เกี่ยวกับเรา</a>
        </li>
        <li class="nav-item">

        <li class="nav-item">
        <?php
        if ($_SESSION['name'] === 'Admin' && $_SESSION['surname'] === 'Mee') {
            echo '<a class="nav-link" href="Edit_member.php">ข้อมูลผู้ใช้งาน</a>';
        }
        ?>
        </li>
          
          <a href="logout.php" class="nav-link list-group-item list-group-item-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

        
        

        <!--เขียนโค้ดตรงนี้-->
        
                <div class="container">
                <main>
            <h1 class="text-center">ข้อมูลผู้ใช้งาน</h1>
            <?php
            // ตรวจสอบว่าผู้ใช้ล็อกอินด้วย ID เป็นอะไร
            $user_id = $_SESSION['id'];

        // ดึงข้อมูลใบแจ้งซ่อมที่เกี่ยวข้องกับผู้ใช้นี้
        $stmt = $conn->prepare("SELECT * FROM tbl_member WHERE id = ?");
        $stmt->bindParam(1, $user_id);
        $stmt->execute();



        // แสดงข้อมูลใบแจ้งซ่อมในรูปแบบตาราง
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
        echo '<tr>
                <th>รหัสผู้ใช้งาน</th>
                <th>ชื่อผู้ใช้งาน</th>
                <th>นามสกุลผู้ใช้งาน</th>
                <th>User ผู้ใช้งาน</th>
                <th>Password ผู้ใช้งาน</th>
            </tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['surname'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

            ?>
        </main>
        </div>

        <!--จบเนื้อหา-->


        <footer class="border-top footer text-muted ">
                <div class="container">
                    &copy; 2566 - ModJirawut - <a href="about.php" >เกี่ยวกับเรา</a>
                    <h6 class="text-danger">ผู้ใช้งาน : <?= $_SESSION['name'].' '.$_SESSION['surname'];?></h6>
                </div>
        </footer>
    </body>
</html>
