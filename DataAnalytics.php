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
        <h1>วิเคราะห์การขาย</h1>
        <h1 class="text-center">Data Analytics</h1>


<form id="searchForm" asp-action="Analytics" method="get">
    <div class="form-group">
        <label for="monthYear">เลือกเดือนและปี:</label>
        <input type="month" id="monthYear" name="monthYear" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary my-2">ค้นหา</button>
</form>

<div id="noDataAlert" class="alert alert-warning mt-3" style="display: none;">
    ไม่มีข้อมูลในเดือนและปีที่เลือก
</div>

<div id="chartContainer">
    <canvas id="myChart"></canvas>
</div>
        </div>



@section Scripts {
    <script>
        document.getElementById('searchForm').addEventListener('submit', function (e) {
            e.preventDefault();

            var selectedMonthYear = document.getElementById('monthYear').value;
            var parts = selectedMonthYear.split('-');
            var selectedMonth = parseInt(parts[1]);
            var selectedYear = parseInt(parts[0]);

            fetch(`/Project/GetProjectsByMonthYear?year=${selectedYear}&month=${selectedMonth}`)
                .then(response => response.json())
                .then(data => {
                    // แก้ไขรหัสด้านล่างนี้เพื่อรวมข้อมูลโปรเจ็กต์ที่มีชื่อเหมือนกัน
                    const mergedData = mergeProjectsByName(data);
                    createAndShowChart(mergedData, 'myChart', mergedData.map(p => p.budgetProject), mergedData.map(p => p.sumAll), mergedData.map(p => p.remainingBudget));
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        function mergeProjectsByName(data) {
            const mergedData = [];

            data.forEach(project => {
                const existingProject = mergedData.find(p => p.nameProject === project.nameProject);

                if (existingProject) {
                    existingProject.budgetProject = project.budgetProject;
                    existingProject.sumAll = project.sumAll;
                    existingProject.remainingBudget = project.remainingBudget;
                } else {
                    mergedData.push({ ...project });
                }
            });

            return mergedData;
        }

        function createAndShowChart(filteredProjects, chartId, budgets, expenses, remainingBudgets) {
            var ctx = document.getElementById(chartId).getContext('2d');
            var existingChart = Chart.getChart(ctx);

            // ถ้ามี Canvas และกราฟอยู่แล้ว ให้ทำลาย Canvas และกราฟเก่าทิ้ง
            if (existingChart) {
                existingChart.destroy();
            }

            var groupedProjects = filteredProjects.reduce(function (accumulator, project) {
                var key = project.nameProject + ' (รหัส: ' + project.idProduct + ', บริษัท: ' + project.customerCompany + ')';
                if (!accumulator[key]) {
                    accumulator[key] = {
                        label: key,
                        budgets: 0,
                        expenses: 0,
                        remainingBudgets: 0,
                    };
                }
                accumulator[key].budgets += project.budgetProject;
                accumulator[key].expenses += project.sumAll;
                accumulator[key].remainingBudgets += project.remainingBudget;
                return accumulator;
            }, {});

            // แปลงข้อมูลที่รวมรายการโปรเจ็กต์แล้วเป็นอาร์เรย์ของข้อมูล
            var projectData = Object.values(groupedProjects);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: projectData.map(function (project) {
                        return project.label;
                    }),
                    datasets: [
                        {
                            label: 'งบประมาณจากลูกค้า',
                            data: projectData.map(function (project) {
                                return project.budgets;
                            }),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'ค่าใช้จ่ายที่ใช้ไป',
                            data: projectData.map(function (project) {
                                return project.expenses;
                            }),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'กำไรที่เหลือ',
                            data: projectData.map(function (project) {
                                return project.remainingBudgets;
                            }),
                            backgroundColor: 'rgba(0, 128, 0, 0.2)', // เปลี่ยนสีเป็นเขียว
                            borderColor: 'rgba(0, 128, 0, 1)', // เปลี่ยนสีเป็นเขียว
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value, index, values) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var label = context.dataset.label || '';
                                    var value = context.parsed.y;
                                    return label + ': ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            if (projectData.length === 0) {
                document.getElementById('noDataAlert').style.display = 'block';
            } else {
                document.getElementById('noDataAlert').style.display = 'none';
            }
        }
    </script>
}

        <!--จบเนื้อหา-->

        <footer class="border-top footer text-muted ">
                <div class="container">
                    &copy; 2566 - ModJirawut - <a href="about.php" >เกี่ยวกับเรา</a>
                    <h6 class="text-danger">ผู้ใช้งาน : <?= $_SESSION['name'].' '.$_SESSION['surname'];?></h6>
                </div>
        </footer>
    </body>
</html>
