<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function success($result, $message, $code = 200,$data_array_name = 'data')
    {
        $response['status_code'] = $code;
        $response['status'] = 'success';
        $response['message'] = $message;
        if ($result != null) {
            $response[$data_array_name] = $result;
        }

        return response()->json($response)->setStatusCode($code);
        $response['status'] = $code;
        $response['message'] = $message;

        $response['data'] = $result;

        return response()->json($response)->setStatusCode($code);
    }

    /**
     * @param string $errors
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    protected function error($errors,$error_message=[], $code)
    {
        $response = [
            'status'=> 'failed',
            'status_code'  => $code,
            'message' => $errors,
            'errors'=> $error_message
        ];

        return response()->json($response)->setStatusCode($code);
    }
}
