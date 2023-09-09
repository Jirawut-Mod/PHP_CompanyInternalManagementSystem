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
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        


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

        



<div class="container">
<h1 class="text-center">รายการจัดซื้อ</h1>


<form method="post" action="submit_create.php">


    <!-- ส่วนที่ตรวจสอบและแสดงข้อมูลโปรเจ็กต์ -->
    <div class="form-group">
        <label>รหัสโปรเจ็กต์</label>
        <input type="text" class="form-control" name="idProduct" id="IdProduct"/>
        
    </div>


    <div class="form-group">
        <label>ชื่อโปรเจ็กต์</label>
        <input type="text" class="form-control" name="nameProject" id="NameProject" />
    </div>

    <div class="form-group">
        <label>บริษัทลูกค้า</label>
        <input type="text" class="form-control" name="customerCompany" id="CustomerCompany" />
    </div>

    <div class="form-group">
        <label>งบประมาณลูกค้า</label>
        <input type="number" class="form-control" name="budgetProject" id="BudgetProject" />
    </div>


    <div class="form-group">
        <label >วัน/เดือน/ปี จัดซื้อ</label>
        <input type="date"  class="form-control" name="startProject"/>
    </div>

    <!-- ส่วนที่คำนวณราคา -->
    <div class="form-group">
        <label >ชื่อรายการจัดซื้อ</label>
        <input type="text" class="form-control" name="Name"/>
    </div>

    <div class="form-group">
        <label >ราคา/หน่วย</label>
        <input type="number"  class="form-control" name="priceUnit" id="PriceUnit"/>
    </div>

    <div class="form-group">
        <label >จำนวน</label>
        <input  type="number"  class="form-control" name="qty" id="Qty"/>
    </div>

    <div class="form-group">
        <label >ราคารวม</label>
        <input type="number" class="form-control" name="price" id="Price"/>
    </div>

    <div class="form-group">
        <label >หมายเหตุ</label>
        <input type="text" class="form-control" name="note"/>
    </div>

    <button type="submit" class="btn btn-primary my-2">บันทึก</button>
    <a class="btn btn-danger my-2" href="ManageProjects.php">ยกเลิก</a>
</div>

    


</form>


</html>


<script>
     const priceUnitInput = document.getElementById('PriceUnit');
     const qtyInput = document.getElementById('Qty');
     const priceInput = document.getElementById('Price');

     priceUnitInput.addEventListener('input', calculateTotalPrice);
     qtyInput.addEventListener('input', calculateTotalPrice);

     function calculateTotalPrice() {
         const priceUnit = parseFloat(priceUnitInput.value) || 0;
         const qty = parseFloat(qtyInput.value) || 0;

         const totalPrice = priceUnit * qty;
         priceInput.value = totalPrice.toFixed();
     }
 </script>


<script>
    const idProductInput = document.getElementById('IdProduct');
    const nameProjectInput = document.getElementById('NameProject');
    const customerCompanyInput = document.getElementById('CustomerCompany');
    const budgetProjectInput = document.getElementById('BudgetProject');
    const priceUnitInput = document.getElementById('PriceUnit');
    const qtyInput = document.getElementById('Qty');
    const priceInput = document.getElementById('Price');
    const noteInput = document.getElementById('Note'); // เพิ่มอิลิเมนต์ใหม่สำหรับหมายเหตุ

    // เมื่อกดปุ่มบันทึก
    document.querySelector('form').addEventListener('submit', function (e) {
        if (
            idProductInput.value.trim() === '' ||
            nameProjectInput.value.trim() === '' ||
            customerCompanyInput.value.trim() === '' ||
            budgetProjectInput.value.trim() === '' ||
            priceUnitInput.value.trim() === '' ||
            qtyInput.value.trim() === '' ||
            priceInput.value.trim() === '' ||
            noteInput.value.trim() === '' // ตรวจสอบหมายเหตุ
        ) {
            e.preventDefault(); // หยุดการส่งฟอร์ม
            alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); // แสดงแจ้งเตือน
        }
    });
</script>




<script>
    const idProductInput = document.getElementById('IdProduct');
const nameProjectInput = document.getElementById('NameProject');
const customerCompanyInput = document.getElementById('CustomerCompany');
const budgetProjectInput = document.getElementById('BudgetProject');

let originalValues = {
    idProduct: '',
    nameProject: '',
    customerCompany: '',
    budgetProject: ''
};

idProductInput.addEventListener('input', () => {
    const idProduct = idProductInput.value;

    fetch(`/CheckProject?id=${idProduct}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                if (idProduct !== originalValues.idProduct) {
                    nameProjectInput.value = data.nameProject;
                    customerCompanyInput.value = data.customerCompany;
                    budgetProjectInput.value = data.budgetProject;
                }

                originalValues.idProduct = idProduct;
                originalValues.nameProject = data.nameProject;
                originalValues.customerCompany = data.customerCompany;
                originalValues.budgetProject = data.budgetProject;

                nameProjectInput.readOnly = true;
                customerCompanyInput.readOnly = true;
                budgetProjectInput.readOnly = true;

            } else {
                // ถ้าไม่มีข้อมูลในฐานข้อมูลให้เปลี่ยน input เป็นสถานะปกติ
                nameProjectInput.value = '';
                customerCompanyInput.value = '';
                budgetProjectInput.value = '';
                nameProjectInput.readOnly = false;
                customerCompanyInput.readOnly = false;
                budgetProjectInput.readOnly = false;
            }
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
});

</script>
