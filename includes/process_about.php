<?php
    require_once("connect.php");

    if (isset($_POST["txtTitle"])) {
        $id = isset($_POST["txtId"]) ? $_POST["txtId"] : null;
        $title = htmlspecialchars(trim($_POST["txtTitle"]));
        $content = htmlspecialchars(trim($_POST["txtContent"]));
    
        $title = filter_var($title, FILTER_SANITIZE_URL);
        $content = filter_var($content, FILTER_SANITIZE_URL);
    
        try {
            if (!empty($id)) {
                $sql = "UPDATE aboutus SET atitle=?, acontent=? WHERE aboutid=?";
                $stmt = $con->prepare($sql);
                $stmt->execute([$title, $content, $id]);
            } else {
                $sql = "INSERT INTO aboutus (atitle, acontent) VALUES(?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->execute([$title, $content]);
            }
            header("location: ../aboutus.php");
            exit();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    if(isset($_GET['delid']))
    {
        $delSql = "DELETE FROM aboutus WHERE aboutid=?";
        $data=array($_GET['delid']);

        try {
            $stmtDel = $con->prepare($delSql);
            $stmtDel->execute($data);
            header("location: ../aboutus.php");
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
?>