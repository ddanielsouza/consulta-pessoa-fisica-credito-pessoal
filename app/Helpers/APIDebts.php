<?php

namespace App\Helpers;
use Error;

class APIDebts
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getDebts($params)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_DIVIDAS_BASE_URL')."/api/debts?". http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ". app('request')->header('Authorization'),
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new Error($err);
        } else {
            return $httpcode === 200 ? json_decode($response)->data : [];
        }
    }
}
