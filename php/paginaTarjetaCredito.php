<?php

$formPaymentType = $_POST["formPaymentType"];
$formName = $_POST["formName"];
$formAddress = $_POST["formAddress"];
$formCity = $_POST["formCity"];
$formState =$_POST["formState"];
$formZip =$_POST["formZip"];
$formCountry =$_POST["formCountry"];
$formProductName =$_POST["formProductName"];
$formQuantity =$_POST["formQuantity"];
$formPrice =$_POST["formPrice"];
$formCurrency =$_POST["formCurrency"];

if ($formPaymentType == "PayPal"){
	$texto = "El pago es a través de PayPal";
} else {
	$texto = "El pago es a través de Tarjeta de crédito";
}


?>
<html>
<head>
<meta charset="UTF-8">
<title>paginaTarjetaCredito</title>
</head>

<body>
Pagina tarjeta credito<br>
<?php print ($texto)?>
</body>
</html>