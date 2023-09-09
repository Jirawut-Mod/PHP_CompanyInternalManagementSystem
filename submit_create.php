<?php
$servername = "localhost";
$username = "root";
$password = ""; // หรือรหัสผ่านของคุณ
$database = "workshop_mee2557"; // ชื่อฐานข้อมูลที่คุณสร้าง

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // ออกจากสคริปต์หรือดำเนินการเพิ่มเติมตามความเหมาะสม
}




// ตรวจสอบการล็อกอิน หากไม่ได้ล็อกอินให้ redirect ไปยังหน้าล็อกอิน
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ดำเนินการตรวจสอบและใช้งานข้อมูล POST ต่อไป

    // ตรวจสอบค่าข้อมูล POST และดำเนินการตามที่คุณต้องการ
    $IdProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : '';
    $NameProject = isset($_POST['nameProject']) ? $_POST['nameProject'] : '';
    $CustomerCompany = isset($_POST['customerCompany']) ? $_POST['customerCompany'] : '';
    $BudgetProject = isset($_POST['budgetProject']) ? $_POST['budgetProject'] : '';
    $StartProject = isset($_POST['startProject']) ? $_POST['startProject'] : '';
    $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $PriceUnit = isset($_POST['priceUnit']) ? $_POST['priceUnit'] : '';
    $Qty = isset($_POST['qty']) ? $_POST['qty'] : '';
    $Price = isset($_POST['price']) ? $_POST['price'] : '';
    $Note = isset($_POST['note']) ? $_POST['note'] : '';

    // ทำงานกับข้อมูล POST ตามที่คุณต้องการ
    // เช่น บันทึกข้อมูลลงในฐานข้อมูล

    $sql = "INSERT INTO tbl_project (IdProduct, NameProject, CustomerCompany, BudgetProject, StartProject, Name, PriceUnit, Qty, Price, Note)
        VALUES (:idProduct, :nameProject, :customerCompany, :budgetProject, :startProject, :Name, :priceUnit, :qty, :price, :note)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idProduct', $IdProduct);
        $stmt->bindParam(':nameProject', $NameProject);
        $stmt->bindParam(':customerCompany', $CustomerCompany);
        $stmt->bindParam(':budgetProject', $BudgetProject);
        $stmt->bindParam(':startProject', $StartProject);
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':priceUnit', $PriceUnit);
        $stmt->bindParam(':qty', $Qty);
        $stmt->bindParam(':price', $Price);
        $stmt->bindParam(':note', $Note);

        $stmt->execute();
        echo '<div id="success-message">บันทึกข้อมูลสำเร็จ!</div>';
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $e->getMessage();
        $pdo = null;
    }
}



// ส่วนที่ใช้ในการตรวจสอบและดึงข้อมูลโปรเจ็กต์
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idProduct = $_GET['id'];
    $sql = "SELECT nameProject, customerCompany, budgetProject FROM tbl_project WHERE IdProduct = :idProduct";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_STR);
        $stmt->execute();
        $projectData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($projectData) {
            // ส่งข้อมูลโปรเจ็กต์กลับในรูปแบบ JSON
            header('Content-Type: application/json');
            echo json_encode([
                'exists' => true,
                'nameProject' => $projectData['nameProject'],
                'customerCompany' => $projectData['customerCompany'],
                'budgetProject' => $projectData['budgetProject']
            ]);
        } else {
            // ไม่พบข้อมูลโปรเจ็กต์ในฐานข้อมูล
            header('Content-Type: application/json');
            echo json_encode(['exists' => false]);
        }
    } catch (PDOException $e) {
        // เกิดข้อผิดพลาดในการดึงข้อมูล
        header('Content-Type: application/json');
        echo json_encode(['error' => 'An error occurred']);
    }
    exit(); // หยุดการทำงานของสคริปต์ที่นี่
}

?>





<script>
    setTimeout(function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none'; // ซ่อนข้อความ
            window.location.href = 'Create.php'; // เปลี่ยนไปยังหน้ารายงาน
        }
    }, 3000); // 3000 มิลลิวินาทีคือ 3 วินาที
</script>


