<?php
    require_once("includes/connect.php");

    $strId = 0;
    $strTitle = "";
    $strContent = "";

    if (isset($_GET["viewid"]))
    {   
        try {
            $id = $_GET["viewid"];
            $sqlLoad = "SELECT * FROM aboutus WHERE md5(aboutid)=?";
            $stmtLoad = $con->prepare($sqlLoad);
            $dataLoad = array($id);
            $stmtLoad->execute($dataLoad);
            if($stmtLoad->rowCount() != 0)
            {
                $rowLoad = $stmtLoad->fetch();
                $strId = $rowLoad[0];
                $strTitle = $rowLoad[1];
                $strContent = $rowLoad[2];
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Start of Header -->
        <?php require_once("includes/header.php"); ?>
        <!-- End of Header -->

        <div id="layoutSidenav">
            <!-- Start of Menu -->
            <?php require_once("includes/menu.php"); ?>
            <!-- End of Menu -->
             
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">About Us</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="blank.php">Dashboard</a> / <a href="aboutus.php">About Us</a> / <?=$strTitle?></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Dashbord Records
                                <div class="mt-2">                 
                                    <a href="aboutus.php" type="button" class="btn btn-primary">
                                    <i class="fa-solid fa-backward"></i>     
                                        Back
                                    </a>
                                </div>
                                
                            </div>

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Records</button>
                                </div>
                            </nav>
                                <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-body">
                                    <h1><?=$strTitle?></h1>
                                    <p><?=$strContent?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Start of Footer -->
                <?php require_once("includes/footer.php"); ?>
                <!-- End of Footer -->
            </div>
        </div>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
