<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost","DanishLam","Dsl140904","pie-chart-test");

    $sqlQuery = "SELECT prog_lan_id, lan_name, progress FROM program_language ORDER BY prog_lan_id";

    $result = mysqli_query($conn,$sqlQuery);

    $data = array();
    foreach ($result as $row) {
    $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>