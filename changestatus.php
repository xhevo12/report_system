<?php
include("config.php");
if (isset($_POST['id'])) {
    $status = ($_POST['status'] == 'paid') ? 'unpaid' : 'paid';
    $sql = "UPDATE invoices SET invoice_status='{$status}' WHERE id={$_POST['id']}";
    $result = mysqli_query($con, $sql);
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
