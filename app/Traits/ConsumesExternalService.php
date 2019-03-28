<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 28/03/2019
 * Time: 12:07 PM
 */

namespace App\Traits;


use GuzzleHttp\Client;

trait ConsumesExternalService
{

    public function performRequest($method,$requestUrl,$form_params = [],$headers = []){
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, ['form_params' => $form_params, 'headers' => $headers]);
        return $response->getBody()->getContents();
    }
}
