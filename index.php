<?php
include("config.php");
?>
<!Doctype html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>Flexpedia</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
			color: black;
			font-family: monospace;
			font-size: 12pt;
			text-align: Left;
		}

		th {
			background-color: #31B404;
			color: white;
		}

		a {
			color: #e8f2fa;
			padding-right: 25px;
			width: 100%;
			font-size: 12pt;
			text-align: center;
			float: center;
			background-color: #31B404;
			border: 1px solid #00407a;
			border-radius: 2px;
		}

		a:hover {
			color: #cfa3cf;
			padding-right: 25px;
			width: 100%;
			font-size: 12pt;
			text-align: center;
			float: center;
			background-color: #0055a3;
			border: 1px solid #00407a;
			text-decoration: none;
			border-radius: 2px;
		}

		.page {
			text-align: center;
		}

		.content {
			margin: 50px;
		}

		.export {
			text-align: center;
		}

		.export input {
			background-color: #F3AC4A;
		}
	</style>
</head>

<body>
	<div class="row">
		<div class="col-md-12">
			<div class="content">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th scope="row">Client</th>
							<th scope="row">Invoice Amount</th>
							<th>Invoice plus Vat</th>
							<th>Vat Rate</th>
							<th>Invoice Status</th>
							<th>Invoice Date</th>
						</tr>
					</thead>
					<?php
					//result for page 
					$results_per_page = 5;
					//number of results stored in database table 
					$sql = "SELECT *FROM invoices";
					$result = mysqli_query($con, $sql);
					$number_of_results = mysqli_num_rows($result);
					//number of total pages available 
					$number_of_pages = ceil($number_of_results / $results_per_page);
					//which page number visitor is currently on 
					if (!isset($_GET['page'])) {
						$page = 1;
					} else {
						$page = $_GET['page'];
					}
					//Sql Limit starting number for the results on the displaying page 
					$this_page_first_result = ($page - 1) * $results_per_page;
					//retrive selected results from the database and display them on page 
					$sql = "SELECT *FROM invoices LIMIT " . $this_page_first_result . ',' . $results_per_page;
					$result = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr>
					<td>"
							. $row['id'] . "</td>
						<td>"
							. $row['client'] . "</td>
						<td>"

							. $row['invoice_amount'] . "</td>
						<td>"
							. $row['invoice_amount_plus_vat'] . "</td>
						<td>"
							. $row['vat_rate'] . "</td>
							<td><button type='button' class='btn " . ($row['invoice_status'] == "paid" ? "btn-success" : "btn-danger") . "  status' data-id='" . $row['id'] . "' data-sta='" . $row['invoice_status'] . "'> "
							. $row['invoice_status'] . "</button></td>
						<td>"
							. $row['invoice_date'] .
							"
					</td></tr>";
					}
					?>
				</table>
				<div class="page">
					<?php
					//displaying links of the pages
					for ($page = 1; $page <= $number_of_pages; $page++) {
						echo '<a href="index.php?page=' . $page . '">' . "   " . $page . '</a>';
					}
					?>
				</div>
				<br>
				<div class="export">
					<form method="post" action="export.php">
						<input type="submit" name="export" value="Export Invoices">
						<input type="submit" name="export_report" value="Export Report">
					</form>

				</div>
			</div>
			<script>
				$(function() {

					$('.status').click(function(e) {
						var id = $(this).attr("data-id");
						var status = $(this).attr("data-sta");
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: 'changestatus.php',
							data: {
								id: id,
								status: status
							},
							success: function(response) {
								var jsonData = JSON.parse(response);

								if (jsonData.success == "1") {
									location.reload(true);
								} else {
									alert('Invalid!');
								}
							}
						});
					});
				});
			</script>
		</div>
	</div>
</body>

</html>