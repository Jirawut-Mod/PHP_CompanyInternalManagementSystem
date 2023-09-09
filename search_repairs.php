<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // หรือรหัสผ่านของคุณ
$database = "workshop_mee2557"; // ชื่อฐานข้อมูลที่คุณใช้

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// เช็คสิทธิ์การเข้าใช้งาน
if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
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

if(empty($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monthYear = $_POST['monthYear']; // ค่ารูปแบบ "YYYY-MM"

    // แยกปีและเดือนจากค่าที่รับมา
    list($year, $month) = explode('-', $monthYear);

    // สร้างค่าใหม่ในรูปแบบ "Y-m-d H:i:s"
    $startDate = "$year-$month-01 00:00:00";
    $endDate = date("Y-m-t", strtotime($startDate)) . " 23:59:59"; // วันสุดท้ายของเดือน
}



// สร้างเงื่อนไขเพื่อค้นหาใบแจ้งซ่อมในช่วงเดือนและปีที่ระบุ
$query = "SELECT * FROM repairs WHERE created_at BETWEEN :startDate AND :endDate";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}



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
$database = "workshop_mee2557"; // ชื่อฐานข้อมูลที่คุณใช้

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


        <main>
    <h1 class="text-center">รายงานใบแจ้งซ่อม</h1>
    <a class="btn btn-primary my-2" href="RepairReport2.php" role="button">กลับไปค้นหา</a>
<?php    
if ($rowCount > 0) {
    // แสดงข้อมูลใบแจ้งซ่อมในรูปแบบตาราง
    echo '<table class="table table-bordered table-striped">';
    echo '<thead>';
    echo '<tr>
            <th>รหัสใบแจ้งซ่อม</th>
            <th>ชื่อพนักงานแจ้งซ่อม</th>
            <th>หัวข้อรายการแจ้งซ่อม</th>
            <th>รายละเอียดแจ้งซ่อม</th>
            <th>รูปภาพ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>อัพเดทการแจ้งซ่อม</th>
            <th>สถานะ</th>
          </tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($repairs as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>
                  <img src="' . $row['repairs_image_url'] . '" alt="รูปภาพ" class="clickable-image" style="max-width: 100px; max-height: 100px;">
              </td>
              ';
        echo '<td>' . $row['created_at'] . '</td>';
        echo '<td>' . $row['updated_at'] . '</td>';
        echo '<td class="status-td" data-status="' . $row['status'] . '">' . $row['status'] . '</td>';


        if ($_SESSION['name'] === 'Admin' && $_SESSION['surname'] === 'Mee') {
            // แสดงปุ่มเฉพาะสำหรับผู้ใช้ "Admin Mee"
            echo '<td>';
            echo '<form method="post" action="update_status.php">';
            echo '<input type="hidden" name="repair_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="start" value="รอดำเนินการ" class="btn btn-secondary my-1" >';
            echo '<input type="submit" name="confirm" value="กำลังดำเนินการ" class="btn btn-primary my-1" >';
            echo '<input type="submit" name="complete" value="เสร็จสิ้น" class="btn btn-success my-1">';
            echo '</form>';
            echo '</td>';
        }

        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<h4 class="text-center">ไม่พบใบแจ้งซ่อมในช่วงเดือนและปีที่ระบุ</h4>';
}



?>
        </main>

        <!--จบเนื้อหา-->

        

        <footer class="border-top footer text-muted ">
                <div class="container">
                    &copy; 2566 - ModJirawut - <a href="about.php" >เกี่ยวกับเรา</a>
                    <h6 class="text-danger">ผู้ใช้งาน : <?= $_SESSION['name'].' '.$_SESSION['surname'];?></h6>
                </div>
        </footer>
    </body>
</html>





<script>
  // เลือกภาพทั้งหมดที่มีคลาส "clickable-image"
const images = document.querySelectorAll('.clickable-image');

// สร้างฟังก์ชันสำหรับแสดงรูปภาพที่ขยาย
function showEnlargedImage(event) {
    const enlargedImage = document.createElement('img');
    enlargedImage.src = event.target.src;
    enlargedImage.alt = 'รูปภาพขยาย';
    enlargedImage.className = 'enlarged-image';
    
    // เพิ่มคลิกเพื่อซ่อนรูปภาพที่ขยาย
    enlargedImage.addEventListener('click', () => {
        enlargedImage.classList.add('hidden');
    });

    // แทรกรูปภาพที่ขยายลงในเอกสาร
    document.body.appendChild(enlargedImage);

    // ลบรูปภาพที่ขยายเมื่อคลิกออกจากหน้านี้
    window.addEventListener('beforeunload', () => {
        enlargedImage.remove();
    });
}

// เพิ่มการจัดการเหตุการณ์คลิกในรูปภาพ
images.forEach((image) => {
    image.addEventListener('click', showEnlargedImage);
});

</script>

<style>
  /* สไตล์ของรูปภาพที่ขยาย */
.enlarged-image {
    max-width: 90%;
    max-height: 90%;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}

/* ซ่อนรูปภาพที่ขยายเริ่มต้น */
.enlarged-image.hidden {
    display: none;
}

/* สีแดงสำหรับสถานะ "รอดำเนินการ" */
td.status-td[data-status="รอดำเนินการ"] {
    color: red;
}

/* สีน้ำเงินสำหรับสถานะ "กำลังดำเนินการ" */
td.status-td[data-status="กำลังดำเนินการ"] {
    color: blue;
}

/* สีเขียวสำหรับสถานะ "เสร็จสิ้น" */
td.status-td[data-status="เสร็จสิ้น"] {
    color: green;
}

</style>

