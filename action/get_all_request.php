<?php

function getAllRequests() {
    include("../settings/connection.php");

    $sql = "SELECT * FROM requests";
    $result = mysqli_query($connection, $sql);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($connection);
    return $requests;
}

