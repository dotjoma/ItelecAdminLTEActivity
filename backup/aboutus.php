<?php
    require_once("includes/connect.php");

    $strId = 0;
    $strTitle = "";
    $strContent = "";

    if (isset($_GET["editid"]))
    {   
        try {
            $id = $_GET["editid"];
            $sqlLoad = "SELECT * FROM aboutus WHERE md5(aboutid)=?";
            $stmtLoad = $con->prepare($sqlLoad);
            $dataLoad = array($id);
            $stmtLoad->execute($dataLoad);
            if ( $stmtLoad->rowCount() != 0)
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
                            <li class="breadcrumb-item active"><a href="blank.php">Dashboard</a> / About Us</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Dashbord Records
                                <!-- <div class="mt-2">                               
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fas fa-plus me-1"></i>
                                        Add New Record
                                    </button>
                                </div> -->
                                
                            </div>

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Records</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Data Entry</button>
                                </div>
                            </nav>
                                <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Content</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <!-- <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Content</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot> -->
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT aboutid, atitle, acontent, md5(aboutid) FROM aboutus";
                                                    $stmt = $con->prepare($sql);
                                                    $stmt->execute();
                                                    $tblAbout="";
                                                    while($row=$stmt->fetch())
                                                    {
                                                        $tblAbout.="<tr>";
                                                        $tblAbout.="<td>{$row[0]}</td>";
                                                        $tblAbout.="<td>{$row[1]}</td>";
                                                        $content=substr(nl2br($row[2]),0,50) . "...";
                                                        $tblAbout.="<td>$content</td>";

                                                        $strViewButton="<button class='btn btn-primary'>
                                                            <a class='text-light' href='view.php?viewid={$row[3]}'>
                                                                <i class='fa-solid fa-magnifying-glass'></i>
                                                            </a>
                                                            </button>";

                                                        $strEditButton="<button class='btn btn-warning'>
                                                            <a class='text-light' href='aboutus.php?editid={$row[3]}'>
                                                                <i class='fa-solid fa-pen-to-square'></i>
                                                            </a>
                                                            </button>";

                                                        $strDelButton="<button class='btn btn-danger'>
                                                            <a class='text-light' href='includes/process_about.php?delid={$row[3]}'>
                                                                <i class='fa-solid fa-trash'></i>
                                                            </a>
                                                            </button>";

                                                        $tblAbout.="<td>{$strViewButton} {$strEditButton} {$strDelButton}</td>";

                                                        $tblAbout.="</tr>";
                                                    }
                                                    echo $tblAbout;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="p-3">
                                        <h3>Data Entry</h3>
                                        <form action="includes/process_about.php" method="POST">
                                            <div class="mb-3">
                                                <input type="hidden" name="txtId" id="txtId" value="<?=$strId?>">
                                                <label for="txtTitle" class="form-label">Title:</label>
                                                <input type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Enter title" value="<?=$strTitle?>" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="txtContent" class="form-label">Content:</label>
                                                <textarea class="form-control" name="txtContent" id="txtContent" placeholder="Enter content" required><?=$strContent?></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-success">SUBMIT</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?=$strContent?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
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
