<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Pago bbva pruebas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css" title="Color">
</head>

<body>
	<?php
$error = false;
$amount = false;

if (isset($_GET['error']))
    $error = $_GET['error'];

if (isset($_GET['amount']))
    $amount = $_GET['amount'];

if (isset($_POST['submitPayment'])) {
    
    $amount = $_POST['amount']; 
    
    if (!is_numeric($amount)) {
        header('Location: http://www.publiwebmexico.com');
    }
    require(dirname(__FILE__) . '/Bbva/Bbva.php');
    $bbva = Bbva::getInstance('ID', 'secret_key');


    $chargeRequest = array(
    'affiliation_bbva' => '788257',
    'amount' => 105.32,
    'description' => 'Cargo inicial a mi merchant',
    'currency' => 'MXN',
    'order_id' => 'oid-00051',
    'redirect_url' => 'https://sand-api.ecommercebbva.com/v1/',
    'card' => array(
            'holder_name' => 'Juan Vazquez',
            'card_number' => '4242424242424242',
            'expiration_month' => '09',
            'expiration_year' => '29'
            'cvv2' => '842'),
    'customer' => array(
        'name' => 'Juan',
        'last_name' => 'Vazquez Juarez',
        'email' => 'juan.vazquez@empresa.com.mx',
        'phone_number' => '554-170-3567')
);

    $affiliation_bbva = 'affiliation_bbva';
    $amount = 'amount';
    $description = 'description'
    $currency = '978';
    $order = 'order_id';
    $redirect_url = 'redirect_url';
    $card = 'card';
    $customer = 'customer';
    $urlMerchant = 'https://bazarexpressmx.com/'; //cambiar este dato
    $urlweb_ok = 'https://bazarexpressmx.com/cart/'; //cambiar este dato
    $urlweb_ko = 'http://www.publiwebmexico.com'; //cambiar este dato

    $miObj->setParameter("DS_MERCHANT_AFFILIATIONBBVA", $affiliation_bbva);
    $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
    $miObj->setParameter("DS_MERCHANT_DESCRIPTION", $description);
    $miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
    $miObj->setParameter("DS_MERCHANT_ORDER", $order);
    $miObj->setParameter("DS_MERCHANT_CARD", $card);
    $miObj->setParameter("DS_MERCHANT_CUSTOMER", $customer);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $urlMerchant);
    $miObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);      
    $miObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);
    ?>

<?php
}
else {   
?>
<div class="jumbotron">
    <h3>Formulario de pago</h3>
    <form class="form-amount" action="https://sand-api.ecommercebbva.com/v1/" method="post">
        <?php if ($error) { ?><div class="alert alert-danger">El valor introducido no es correcto. Debe introducir por ejemplo: 50.99</div><?php } ?>
        <div class="form-group">
            <label for="amount">Importe</label>
            <input type="text" id="amount" name="amount" class="form-control"<?php if ($amount) { ?> value="<?php echo $amount; ?>"<?php }else{ ?> <?php } ?>>
        </div>
        <input class="btn btn-lg btn-primary btn-block" name="submitPayment" type="submit" value="Pagar">
    </form> 
</div>    
</body>
</html>
