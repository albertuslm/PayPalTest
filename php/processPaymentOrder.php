<?php

session_start();

$formPaymentType = $_POST["formPaymentType"];

$_SESSION['formName'] = $_POST['formName'];
$_SESSION['formAddress'] = $_POST['formAddress'];
$_SESSION['formCity'] = $_POST['formCity'];
$_SESSION['formState'] =$_POST['formState'];
$_SESSION['formZip'] =$_POST['formZip'];
$_SESSION['formCountry'] =$_POST['formCountry'];
$_SESSION['formProductName'] =$_POST['formProductName'];
$_SESSION['formQuantity'] =$_POST['formQuantity'];
$_SESSION['formPrice'] =$_POST['formPrice'];
$_SESSION['formCurrency'] =$_POST['formCurrency'];

if ($formPaymentType == "PayPal"){
	echo '<script language="JavaScript"> window.location ="CreatePaymentUsingPayPal.php" </script>';
	//include ("paginaPayPal.php");
} else {
	$creditCardType = $_POST['formGroupPayment'];
	$_SESSION['creditCardType'] =$creditCardType;

	//if (isset($_POST['formCardNum']) && isset($_POST['formCardUserName']) && isset($_POST['formExpMonth']) && isset($_POST['formExpYear']) && isset($_POST['formSecurityCode'])){
	 	$_SESSION['formCardNum'] =$_POST['formCardNum'];
		$_SESSION['formCardUserName'] =$_POST['formCardUserName'];
		$_SESSION['formExpMonth'] =$_POST['formExpMonth'];
		$_SESSION['formExpYear'] =$_POST['formExpYear'];
		$_SESSION['formSecurityCode'] =$_POST['formSecurityCode'];
		echo '<script language="JavaScript"> window.location ="CreatePayment.php" </script>';

	/*} else {
	//	echo '<script language="JavaScript"> window.location ="CreatePaymentUsingPayPal.php" </script>';
	}
	
	
	//include ("paginaTarjetaCredito.php");
	*/
}
?>