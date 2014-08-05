<?php

// # CreatePayment

require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\CreditCard;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Transaction;

// ### CreditCard
// A resource representing a credit card that can be
// used to fund a payment.
session_start();


// ### Shipping Address
// (Optional) Lets you specify item wise
// information
$shipAdd = new ShippingAddress();
$shipAdd->setRecipient_name("My Address")
	->setLine1($_SESSION['formAddress'])
	->setCity($_SESSION['formCity'])
	->setCountryCode($_SESSION['formCountry'])
	->setPostalCode($_SESSION['formZip'])
	->setState($_SESSION['formState']);
	
$card = new CreditCard();
$card->setType($_SESSION['creditCardType'])
	->setNumber($_SESSION['formCardNum'])
	->setExpireMonth($_SESSION['formExpMonth'])
	->setExpireYear($_SESSION['formExpYear'])
	->setCvv2($_SESSION['formSecurityCode'])
	->setBillingAddress($shipAdd)
	->setFirstName($_SESSION['formName']);

// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.

$payer = new Payer();
$payer->setPaymentMethod("credit_card")
	->setFundingInstruments(array($fi));

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName($_SESSION['formProductName'])
	->setCurrency($_SESSION['formCurrency'])
	->setQuantity($_SESSION['formQuantity'])
	->setPrice($_SESSION['formPrice']);

$itemList = new ItemList();
$itemList->setItems(array($item1));


	
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency($_SESSION['formCurrency'])
	->setTotal($_SESSION['formPrice']);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription("Crazy Jamon Iberico");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent("sale")
	->setPayer($payer)
	->setTransactions(array($transaction));

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
	$payment->create($apiContext);
} catch (PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}
?>
<html>
<head>
	<title>Direct Credit card payments</title>
</head>
<body>
	<div>
		Created payment:
		<?php echo $payment->getId();?>
	</div>
	<a href='../index.html'>Back</a>
</body>
</html>
