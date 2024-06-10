<?php
namespace App\Helpers;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ResponseHelper {
    static function getResponse($code, $message, $resourse): Response
    {
        //$resultArr['code'] = $code;
        $resultArr['message'] = $message;

        if($resourse instanceof ResourceCollection){
            $resultArr['data'] = $resourse;
        }elseif(!empty($resourse) && \is_array($resourse)){
            $resultArr['data'] = $resourse;
        }else{
            $resultArr['data'] = (!empty($resourse) && $resourse->resource) ? $resourse : new \stdClass();
        }
        return new Response($resultArr, $code);
    }
}