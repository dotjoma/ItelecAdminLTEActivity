<?php
    require_once("includes/connect.php");

    $strId = 0;
    $strTitle = NULL;
    $strAuthor = NULL;
    $strdatePosted = NULL;
    $strstory = NULL;

    if (isset($_GET["editid"])) {
        try {
            $id = $_GET["editid"];
            $sqlLoad = "SELECT * FROM news WHERE md5(id)=?";
            $stmtLoad = $con->prepare($sqlLoad);
            $stmtLoad->execute([$id]);
            if ($stmtLoad->rowCount() != 0) {
                $rowLoad = $stmtLoad->fetch();
                $strId = $rowLoad[0];
                $strTitle = $rowLoad[1];
                $strAuthor = $rowLoad[2];
                $strdatePosted = $rowLoad[3];
                $strstory = $rowLoad[4]; 
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
                        <h1 class="mt-4">News</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="blank.php">Dashboard</a> / News</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Dashbord Records
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
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>DatePosted</th>
                                                    <th>Story</th>
                                                    <th>Picture</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT id, title, author, date_posted, story, picture, md5(id) FROM news";
                                                    $stmt = $con->prepare($sql);
                                                    $stmt->execute();
                                                    $tblnews="";
                                                    while($row=$stmt->fetch())
                                                    {
                                                        $tblnews.="<tr>";
                                                        $tblnews.="<td>{$row[0]}</td>";
                                                        $tblnews.="<td>".substr(nl2br($row[1]), 0, 50)."...</td>";
                                                        $tblnews.="<td>{$row[2]}</td>";
                                                        $tblnews.="<td>{$row[3]}</td>";
                                                        $tblnews .= "<td>" . substr(nl2br($row[4]), 0, 100) . "...</td>";

                                                        $pic=strlen($row[5])==0? "nopic.png" : $row[5];
                                                        $strPic="<img src='./uploads/news/{$pic}' height='50' width='50'";

                                                        $strViewButton = "<button class='btn btn-primary'>
                                                                <a class='text-light' href='viewnews.php?viewid={$row[6]}'>
                                                                    <i class='fa-solid fa-eye'></i>
                                                                </a>
                                                            </button>";
                                                        $strEditButton="<button class='btn btn-warning'>
                                                                <a class='text-light' href='news.php?editid={$row[6]}'>
                                                                    <i class='fa-solid fa-pen-to-square'></i>
                                                                </a>
                                                            </button>";
                                                        $strDelButton = "<button class='btn btn-danger'>
                                                            <a class='text-light' href='includes/savenews.php?delid={$row[6]}'>
                                                                <i class='fa-solid fa-trash'></i>
                                                            </a>
                                                        </button>";

                                                        $tblnews.="<td>{$strPic}</td>";
                                                        $tblnews.="<td>{$strViewButton} {$strEditButton} {$strDelButton}</td>";
                                                        $tblnews.="</tr>";
                                                    }
                                                    echo $tblnews;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="p-3">
                                        <h3>Data Entry</h3>
                                        <form action="includes/savenews.php" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <input type="hidden" name="txtId" id="txtId" value="<?=$strId?>">
                                                <label for="txtTitle" class="form-label">Title :</label>
                                                <input type="text" class="form-control" name="txtTitle" value='<?= $strTitle ?>' />
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="txtAuthor" class="form-label">Author :</label>
                                                    <input type="text" class="form-control" name="txtAuthor" value='<?= $strAuthor ?>' />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="dtDate" class="form-label">Date Posted :</label>
                                                    <input type="date" class="form-control" name="dtDate" value='<?= $strdatePosted ?>' />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="story" class="form-label">Story :</label>
                                                <textarea class="form-control" id="txtStory" name="txtStory" rows="5" required><?= $strstory ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="story" class="form-label">Image :</label>
                                                <input type="file" name="picture" accept="image/*">
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
