<?php
define('STRIPE_SECRET_KEY','sk_test_o78wLMdkoq9mgWHnFs1B73kO');
define('STRIPE_PUBLISHABLE_KEY','pk_test_4KUXuV4MKMN0nCyrwa2e2lQJ');
header('Content-Type: application/json');
$results = array();
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
try{
    $products  = \Stripe\Product::all();
    $results['response'] = "Success";
    $results['products'] = $products->data;

}catch (Exception $e){
    $results['response'] = "Error";
    $results['products'] = $e->getMessage();
}
echo json_encode($results);
