<?php
define('STRIPE_SECRET_KEY','[sk_test_o78wLMdkoq9mgWHnFs1B73kO]');
define('STRIPE_PUBLISHABLE_KEY','[pk_test_4KUXuV4MKMN0nCyrwa2e2lQJ]');
header('Content-Type: application/json');
$results = array();
//require 'vendor/autoload.php';
require_once('init.php');
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
if(isset($_POST['method'])){
    $method = $_POST['method'];
    if($method =="charge"){
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $source = $_POST['source'];
        $description = $_POST['description'];
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount, // Amount in cents
                "currency" => $currency,
                "source" => $source,
                "description" => $description
            ));
            if($charge!=null){
                $results['response'] = "Success";
                $results['message'] = "Charge has been completed";
            }
        } catch(\Stripe\Error\Card $e) {
            $results['response'] = "Error";
            $results['message'] = $e->getMessage();
        }
        echo json_encode($results);
    }else {
        $results['response'] = "Error";
        $results['messsage'] = "Method name is not correct";
        echo json_encode($results);
    }
}else {
    $results['response'] = "Error";
    $results['message'] = "No method has been set";
    echo json_encode($results);
}

