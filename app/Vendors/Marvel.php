<?php

namespace App\Vendors;
use App\Exceptions\DuithapeException as Exception;
use App\Helpers\GuzzleHelpers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use League\OAuth1\Client\Server\Server;

class Marvel{
    /**
    * Your merchant's server key
    * @static
    */
    public static $serverKey;
    public static $publicKey;
    public static $base_uat_url;
    public static $base_prod_url;

    /**
      * true for production
      * false for sandbox mode
      * @static
      */
    public static $isProduction;

    /**
    * Default options for every request
    * @static
    */
    public static $curlOptions = array();

    public function config($params)
    {

    }


    public static function getSnapBaseUrl()
    {
        return Marvel::$isProduction ?
        Marvel::$base_prod_url  : Marvel::$base_uat_url;
    }

    /**
     * Send GET request
     * @param string  $url
     * @param string  $server_key
     * @param mixed[] $data_hash
     */
    public static function get($url, $server_key = '', $data_hash, $isForm)
    {
        $queryparam = Marvel::transformAuth($data_hash);
        // dd($queryparam);
        return self::remoteCall($url, $server_key, $queryparam, false, $isForm);
    }

    /**
     * Send POST request
     * @param string  $url
     * @param string  $server_key
     * @param mixed[] $data_hash
     */
    public static function post($url, $server_key = '', $data_hash, $isForm)
    {
        return self::remoteCall($url, $server_key, $data_hash, true, $isForm);
    }

    /**
     * Send POST request
     * @param string  $url
     * @param string  $server_key
     * @param mixed[] $data_hash
     */
    public static function postMultipart($url, $server_key = '', $data_hash, $bearer_token=null)
    {
        $client = new Client();
        try{
            $result = $client->request("POST", $url,
            [
                'headers' => ['Authorization' => "Bearer {$bearer_token}"],
                'multipart' => $data_hash
            ]);
            
        if ($result->getStatusCode() != 200) {
            $message = $result->getBody()->getContents();
            Log::info($message);
            return $message;
        } else {
            return $result->getBody()->getContents();
        }
        }catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString['data'] = json_decode($response->getBody()->getContents());
            $responseBodyAsString['statusCode'] = $response->getStatusCode();
            return json_encode($responseBodyAsString);
        }
        
    }

    /**
   * Actually send request to API server
   * @param string  $url
   * @param string  $server_key
   * @param mixed[] $data_hash
   * @param bool    $post
   */
    public static function remoteCall($url, $server_key = '', $data_hash, $post = true, $isForm)
    {
        Log::info($url);
        if($post && !$isForm)
        {
            $result = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ])->post($url, $data_hash);
        }

        if($post && $isForm){
            $result = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ])->asForm()->post($url, $data_hash);
        }

        if(!$post && $isForm){
            // $result = Http::asForm()->get($url, $data_hash);
            $result = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ])->asForm()->get($url, $data_hash);
        }

        if(!$post && !$isForm){
            Log::info('URL: '.$url);
            Log::info('Key: '.$server_key);
            Log::info($data_hash);
            $result = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ])->get($url, $data_hash);
        }
        // Log::info($result);
         if (((200 <= $result->getStatusCode()) && ($result->getStatusCode() <= 209))) {
            $message = json_decode($result->getBody()->getContents(),true);
            $message['statusCode'] = $result->getStatusCode();
            return $message;
        } else {
            $responseBodyAsString['data'] = json_decode($result->getBody()->getContents());
            $responseBodyAsString['statusCode'] = $result->getStatusCode();
            return $responseBodyAsString;
        }
    }

    public static function transformAuth($data_hash){
        $time = strtotime(now());
        $hash = md5($time.Marvel::$serverKey);
        $transform = [
            "ts" => (string)$time,
            "apikey"=>Marvel::$publicKey,
            "hash"=>$hash
        ];
        $queryparam = array_merge($data_hash,$transform);
        return $queryparam;
    }

    public static function getCharacters($params){
        $result = Marvel::get(
            Marvel::getSnapBaseUrl() . '/v1/public/characters',
            Marvel::$publicKey,
            $params,
            false
        );
        return $result;
    }
}