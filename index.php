<?php
    header('Content-Type: text/html;charset=UTF-8');
	include 'include_sqlconnection.php';
	$userName = "everybody";
	if(isset($_REQUEST["userName"]) && $_REQUEST["userName"] != ""){
		$userName = $_REQUEST["userName"];
	}
?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="wordFieldWidget.js"></script>
<script src="verbTempusWidget.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Finnish exercises</title>

</head>
<body>
<?php
    include("crude.html");
?>
</body>
</html>
