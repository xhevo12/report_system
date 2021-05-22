<?php
include("config.php");
header('Content-type: application/csv');

if (isset($_POST["export"])) {
    $filename = "invoices_csv.csv";
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen("php://output", "w");
    $header = array('Invoice ID', 'Company Name', 'Invoice Amount');
    fputcsv($output, $header);
    //Or fputcsv($output, array('Invoice ID', 'Company Name', 'Invoice Amount'));
    $sql = "select A.invoice_id,B.client,A.amount
    from invoice_items A, invoices B
    where B.id=A.invoice_id";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_row($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
} 

if (isset($_POST["export_report"])) {
    $filename = "customer_report_csv.csv";
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen("php://output", "w");
    $header = array('Company Name', 'Total Invoiced Amount', 'Total Amount Paid', 'Total Amount Outstanding');
    fputcsv($output, $header);
    $sql = "SELECT  client,
			SUM(invoice_amount_plus_vat),
			SUM(IF(invoice_status='paid', invoice_amount_plus_vat, 0)) as payed,
			SUM(IF(invoice_status='unpaid', invoice_amount_plus_vat, 0))  as outstanding
			FROM invoices
			GROUP BY client";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_row($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
