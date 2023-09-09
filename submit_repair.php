<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // หรือรหัสผ่านของคุณ
$database = "workshop_mee2557"; // ชื่อฐานข้อมูลที่คุณสร้าง

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$messages = array(); // สร้างตัวแปรเก็บข้อความแจ้งเตือน

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reporter = $_POST['reporter'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // ตรวจสอบว่ามีไฟล์รูปภาพถูกอัปโหลดหรือไม่
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // กำหนดตำแหน่งและชื่อไฟล์รูปภาพที่จะบันทึก
        $image_dir = 'uploads/'; // โฟลเดอร์ที่เก็บรูปภาพ
        $image_name = uniqid() . '_' . $_FILES['image']['name'];
        $image_path = $image_dir . $image_name;

        // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ปลายทาง
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

        // บันทึกข้อมูลการแจ้งซ่อมลงในฐานข้อมูล
        $currentDatetime = date("Y-m-d H:i:s"); // วันที่และเวลาปัจจุบัน
        try {
            $stmt = $conn->prepare("INSERT INTO repairs (user_name, title, description, status, repairs_image_url, updated_at) VALUES (?, ?, ?, 'รอดำเนินการ', ?, ?)");
            $stmt->bindParam(1, $reporter, PDO::PARAM_STR);
            $stmt->bindParam(2, $title, PDO::PARAM_STR);
            $stmt->bindParam(3, $description, PDO::PARAM_STR);
            $stmt->bindParam(4, $image_path, PDO::PARAM_STR);
            $stmt->bindParam(5, $currentDatetime, PDO::PARAM_STR);

            // ดำเนินการ execute คำสั่ง SQL
            $stmt->execute();

            // เพิ่มข้อความแจ้งเตือนใน $messages
            $messages[] = array(
                'repair_id' => $conn->lastInsertId(),
                'status' => 'รายการแจ้งซ่อมถูกสร้าง',
            );

            // ตรวจสอบสถานะการส่ง LINE Notify แต่ละรายการและส่งข้อความ LINE Notify
            foreach ($messages as $message) {
                $repair_id = $message['repair_id'];
                $status = $message['status'];

                // รหัสแจ้งซ่อม
                //$token = "B8P56YJFt0GzBu3IEvEq9D2LV3Gsv04gwJXJJsq6frP";
                $token = "dDUDRfc21MmnW6575qZ24azRyFNkNHkGX5ppxajalMI";

                // สร้างข้อความแจ้งเตือน
                $message = "มีรายการแจ้งซ่อมใหม่: \n\n";
                $message .= "รหัสแจ้งซ่อม: " . $repair_id . "\n";
                $message .= "ผู้แจ้ง: " . $reporter . "\n";
                $message .= "หัวข้อ: " . $title . "\n";
                $message .= "รายละเอียด: " . $description . "\n";
                date_default_timezone_set('Asia/Bangkok'); // ตั้งโซนเวลาเป็น Asia/Bangkok (ICT)
                

                $created_at = date("Y-m-d H:i:s");
                $message .= "วันที่แจ้งซ่อม: $created_at\n";

                // กำหนด URL ของรูปภาพ
                $image_url = 'http://localhost:8080/PHP%20Mee2557-project/' . $image_path;
                $message .= "รูปภาพอาการ: $image_url";

                // ส่งข้อความแจ้งเตือน LINE Notify
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://notify-api.line.me/api/notify",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query(array('message' => $message)),
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ".$token,
                        "Cache-Control: no-cache",
                        "Content-type: application/x-www-form-urlencoded"
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                echo "รหัสแจ้งซ่อม: " . $repair_id . ", สถานะ: " . $status . "<br>";
            }
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลการแจ้งซ่อม: " . $e->getMessage();
        }
    } else {
        echo "กรุณาอัปโหลดไฟล์รูปภาพ";
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn = null;
}
?>

<script>
    setTimeout(function () {
        <?php
        // ตรวจสอบสถานะการส่ง LINE Notify แต่ละรายการและส่งข้อความ LINE Notify
        foreach ($messages as $message) {
            $repair_id = $message['repair_id'];
            $status = $message['status'];

            // รหัสแจ้งซ่อม
            //$token = "B8P56YJFt0GzBu3IEvEq9D2LV3Gsv04gwJXJJsq6frP";
            $token = "dDUDRfc21MmnW6575qZ24azRyFNkNHkGX5ppxajalMI";
            

            // ส่งข้อความแจ้งเตือน LINE Notify
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://notify-api.line.me/api/notify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query(array('message' => $message)),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".$token,
                    "Cache-Control: no-cache",
                    "Content-type: application/x-www-form-urlencoded"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
        ?>
        // เมื่อส่ง LINE Notify เสร็จสิ้น ให้เปลี่ยนเส้นทางไปที่ RepairReport2.php
        window.location.href = 'RepairReport2.php';
    }, 3000); // 3000 มิลลิวินาทีคือ 3 วินาที
</script>

