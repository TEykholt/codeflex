<?php
// Fetching JSON
$req_url = 'https://api.exchangerate-api.com/v4/latest/EUR';
$response_json = file_get_contents($req_url);
function convertCurrency($price, $currency)
{
    global $response_json;
    if (false !== $response_json) {
        try {
            $response_object = json_decode($response_json);
            $price = round(($price * $response_object->rates->$currency), 2);

        } catch (Exception $e) {
            var_dump($e);
        }
    }
    return $price;
}