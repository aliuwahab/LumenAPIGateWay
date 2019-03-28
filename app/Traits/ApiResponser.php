<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 26/03/2019
 * Time: 7:35 AM
 */

namespace App\Traits;


use Illuminate\Http\Response;

trait ApiResponser
{

    /**
     * @param $data
     * @param int $code
     * @return Response
     */
    public function successResponse($data, $code = Response::HTTP_OK){
        return response($data, $code)->header('Content-Type', 'application/json');
    }


    /**
     * Build error message
     *
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code){
        return response()->json(['error' => $message,'code' => $code], $code);
    }


    /**
     * @param $message
     * @param $code
     * @return Response
     */
    public function errorMessage($message, $code){
        return response($message, $code)->header('Content-Type', 'application/json');
    }



}
