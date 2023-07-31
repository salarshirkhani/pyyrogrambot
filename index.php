<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css" media="only screen and (min-width: 1200px)">
    <link rel="stylesheet" href="css/modal.css" media="only screen and (min-width: 1200px)">
    <link rel="stylesheet" href="style/style-mobile.css" media="only screen and (max-width: 576px)">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<?php require ("read.php"); ?> 
    <style>
        p{
            font-family: iranyekanvbold;
        }
        .table {
                 background: rgb(255 255 255) !important;
                 color: #2c2b2b;
                 width: 100%;
                 max-width: 1300px;
                 border-radius: 7px;
                 padding: 40px;
                 overflow-x: auto;
                 font-family: iranyekanvbold;
             }
             .table thead {
                 vertical-align: bottom;
                 background: #6374ff;
                 color: white;
                 border-radius: 7px !important;
             }
             .table tfoot {
                 vertical-align: bottom;
                 background: #6374ff;
                 color: white;
                 border-radius: 7px !important;
             }
             
             table {
                 border-collapse: collapse;
                 margin: 50px 0px;
             }
             .table-hover tbody tr:hover {
                 background-color: rgba(0,0,0,.075);
             }
             
             .table-striped tbody tr:nth-of-type(odd) {
                 background-color: rgba(0,0,0,.05);
             }
             .table-bordered thead td, .table-bordered thead th {
             }
             .table thead th {
                 vertical-align: bottom;
                 border-bottom: 2px solid #dee2e6;
             }
             .table-bordered td, .table-bordered th {
             }
             .table td, .table th {
                 padding: 0.75rem;
                 vertical-align: top;
                 text-align: center;
             }
             .add-button {
                 background: #69c397;
                 padding: 10px;
                 border: none;
                 border-radius: 3px;
                 color: white;
                 margin-top: 50px;
             }
                         
             .add-button:hover{
                 background: #07b107;
             }
             .table tr td {
                 color: #2c2b2b;
             }
             </style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <main class="container">
        <div class="ma-dsh  row">
            <!-- main page site -->
            <section class="main-bar col-xl-12 col-12" style="padding: 0% 4%;">
                <!-- dashbord site ba-hm -->
                <div class="section-dsh row main-bar disflex col-xl-12 col-12" >
                    <div class="col-xl-8 col-5" >
                        <h1>داشبورد</h1>
                    </div>
                    <div class="row col-xl-4 col-7 disflex">

                    </div>
                </div>
                <!-- Diagram and chart section -->
                <div style="margin-top: 100px;" class="Diagram row main-bar col-xl-12 col-12">
                    <div>
                        <span>نمودار</span>
                        <span>پیام به بازدید</span>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>

                <div class="grayBlueBg">
                    
                    <table class="table  table-hover table table-striped table-condensed " style='color: white; overflow-x:auto; margin-right: auto; margin-left: auto;'>
                        <thead>
                        <tr>
                            <th>نام کانال</th>
                            <th>آیدی کانال</th>
                            <th>ایدی پیام</th>
                            <th>متن</th>    
                            <th>تاریخ</th>
                            <th>بازدید</th>
                            <th>نمایش</th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php foreach($result as $item){ ?>
                            <tr>
                                <td><?php echo $item['channel_name']; ?></td>
                                <td><?php echo $item['channel_id']; ?></td>
                                <td><?php echo $item['Message ID']; ?></td>
                                <td><?php echo substr($item['Text'], 0, 79); ?></td>
                                <td><?php echo $item['Date']; ?></td>
                                <td><?php echo $item['view']; ?></td>
                                <td><a style="background: rgb(0, 195, 255);padding: 6px;border-radius: 3px;color: white;" data-toggle="modal" data-target="#usdt" class="btn btn-success">نمایش</a></td>
                            </tr>
                            <div class="modal fade show" id="usdt" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-danger">
                                  <div class="modal-content ">
                                    <div class="modal-header">
                                      <h4 class="modal-title">نمایش </h4>
                                      <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                                        <span  aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 alert alert-info">
                                                 <?php echo $item['Text']; ?>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                    تعداد فوروارد : <?php echo $item['forward']; ?>
                                    بازدید : <?php echo $item['view']; ?>
                                   </div>
                                  </div>
                                 </div>
                            </div> 
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr style="border-top:2px solid white;">
                                <th>نام کانال</th>
                                <th>آیدی کانال</th>
                                <th>ایدی پیام</th>
                                <th>متن</th>    
                                <th>تاریخ</th>
                                <th>بازدید</th>
                                <th>نمایش</th>
                            </tr>
                            </tfoot>
                    </table>
    
            </div>

            </section> 
        </div>
    </main>

    <footer class="container-fluid footer-dsh" >
        <div class="row col-xl-12 col-12 disflex" style="height: 61px;">
            <div class="col-xl-4 col-7"> 
                <span>توسط سالار شیرخانی و علی زرین کوه</span>
            </div>
            <div class="col-xl-6 col-1">

            </div>
            <div class="col-xl-1 col-4">
                     
            </div>
        </div>
    </footer>

    <!--javascript-->
    <script>
        // diagram dashborad ba-ham
        var xValues = [<?php foreach($result as $item){ ?> <?php echo $item['Message ID']; ?> , <?php } ?>];
        var yValues = [<?php foreach($result as $item){ ?> <?php echo $item['view']; ?> , <?php } ?>];
        var barColors = ["red", "green","blue","orange","brown"];

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            }
        }
        });
        ///menu-bar-mobile js
        const menuBtn = document.querySelector('.menu-btn');
        const menu = document.querySelector('.menu');
                
        let showMenu = false;
                
        menuBtn.addEventListener('click', toggleMenu);
                
        function toggleMenu() {
        if (!showMenu) {
            menu.classList.add('show');
            showMenu = true;
        } 
        else {
            menu.classList.remove('show');
            showMenu = false;
        }
        }
        //   
        const viewportWidth = screen.width;
        if (viewportWidth >= 1000) {
        $('#side').stick_in_parent(); 
        }     

        // diagram dashborad 2
        var xxValues = ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهار شنبه", "پنج شنبه", "جمعه"];
        var yyValues = [26, 49, 44, 25, 0];
        var barrColors = ["red", "green","blue","orange","brown"];

        new Chart("myChart2", {
        type: "bar",
        data: {
            labels: xxValues,
            datasets: [{
            backgroundColor: barColors,
            data: yyValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            }
        }
        });

    </script>
    <!-- Bootstrap 4 -->
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
crossorigin="anonymous"></script>
</body>

</html>
