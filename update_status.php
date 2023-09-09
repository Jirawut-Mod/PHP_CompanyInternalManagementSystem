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

if (!empty($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $repair_id = $_POST['repair_id'];
  
    if (isset($_POST['confirm'])) {
      // ถ้าคลิกปุ่ม "ยืนยัน"
      $status = "กำลังดำเนินการ";
    } elseif (isset($_POST['complete'])) {
      // ถ้าคลิกปุ่ม "เสร็จสิ้น"
      $status = "เสร็จสิ้น";
    } elseif (isset($_POST['start'])) {
        // ถ้าคลิกปุ่ม "รอดำเนินการ"
      $status = "รอดำเนินการ";
    }
  
    // ปรับปรุงสถานะและค่า updated_at ใบแจ้งซ่อม
    date_default_timezone_set('Asia/Bangkok'); // กำหนดเขตเวลาเป็น Bangkok (ICT)
    $currentDatetime = date("Y-m-d H:i:s"); // วันที่และเวลาปัจจุบัน (ตาม ICT)

    $stmt = $conn->prepare("UPDATE repairs SET status = ?, updated_at = ? WHERE id = ?");
    $stmt->execute([$status, $currentDatetime, $repair_id]);
  
    header('Location: search_repairs.php');
    
  } else {
    header('Location: login.php');
    exit();
  }
  
?>
