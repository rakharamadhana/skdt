<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('auth_data')) {
    /**
     * get auth data from session
     * @return auth_data
     */
    function auth_data()
    {
        return Session::get('auth_data');
    }
}

if (!function_exists('many_to_text')) {
    /**
     * get auth data from session
     * @return auth_data
     */
    function many_to_text($items, $field)
    {
        $text = '';
        $i = 0;
        foreach($items as $item){
            if ($i == 0)
                $text .= $item->{$field};
            else
                $text .= ', ' . $item->{$field};
            
            $i++;
        }
        return $text;
    }
}

if (!function_exists('success_response')) {
    /**
     * return success response of web operation
     * @param any $message ,
     * @param int $status_code,
     * @return array
     */
    function success_response($message, $payload_data = [], $status_code = 200)
    {
        $return_array = [
            'status' => 'Success',
            'status_code' => $status_code,
            'message' => $message,
        ];

        if(!empty($payload_data)){
            $return_array['data'] = $payload_data;
        }

        return response()->json($return_array);
    }
}

if (!function_exists('error_response')) {
    /**
     * return error response of web operation
     * @param any $message ,
     * @param int $status_code,
     * @return array
     */
    function error_response($message, $payload_data = [], $status_code = 300)
    {
        if ($message instanceof Exception) {
            $message = isDebugMode() ? $message->getMessage() : 'Failed code ' . $message->getLine();
        }

        $return_array = [
            'status' => 'Failed',
            'status_code' => $status_code,
            'message' => $message,
        ];

        if(!empty($payload_data)){
            $return_array['data'] = $payload_data;
        }

        return response()->json($return_array);
    }
}

if (!function_exists('isDebugMode')) {
    /**
     * check is debug mode of the system active
     * @return array
     */
    function isDebugMode()
    {
        return env('APP_DEBUG', 'true') == 'true';
    }
}

if (!function_exists('slugtify')) {
    /**
     * convert text to slug post
     * @return text
     */
    function slugtify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}