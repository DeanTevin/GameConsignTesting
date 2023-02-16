<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ResponseHelper
{

    /**
     * Formatted Json Response to FrontEnd
     * @param int $code
     * @param $data
     * @param String $message
     * @param $errors
     * @param array $header
     * @return JsonResponse
     */
    public static function json($data, int $code, $message = '', $errors = [], $header = [], $status = 'success'): JsonResponse
    {
        if(!((200 <= $code) && ($code <= 209)))
        {
            $status = 'Failed';
        $response = ['data' => $data, 'message' => $message, 'errors' => $errors, 'status' => $status, 'code' => $code];

        Log::alert($response);
        Log::alert($errors);
        }
        $response = ['data' => $data, 'message' => $message, 'errors' => $errors, 'status' => $status, 'code' => $code];
        return response()->json($response, $code, $header);
    }

    /**
     * 
     * @param $response
     * 
     * @return JsonResponse
     */
    public static function RequestValidate($request){
        if (isset($request->validator) && $request->validator->fails()) {
            return ['validate'=>false,'data'=>$request->validator->messages()];
        }else{
            return ['validate'=>true,'data'=>$request->all()];
        }
    } 
}
