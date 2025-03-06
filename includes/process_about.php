<?php
    require_once("connect.php");

    $title = $_GET["txtTitle"];
    $content = $_GET["txtContent"];
    echo "{$title} - {$content}";

    try {
        $sql = "INSERT INTO aboutus (atitle, acontent) VALUES(?, ?)";
        $data = array($title, $content);
        $stmt = $con->prepare($sql);
        $stmt->execute($data);
        header("location: ../aboutus.php");
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
?>