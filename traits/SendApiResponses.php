<?php

namespace traits;
trait SendApiResponses
{
    /**
     *  Handles response for successful requests
     * @param $data
     * @param string|null $message
     * @return false|string
     */

    public function successResponse($data, string $message = null)
    {
        $array = [
            'data' => $data,
            'status' => http_response_code(200),
            'message' => $message ?? 'Successful',
        ];

        header('Content-type: application/json');
        return json_encode($array);
    }

    /**
     * Handles response for failed requests
     *
     * @param string $message
     * @param int|null $code
     * @param array $data
     * @return false|string
     */
    public function failureResponse(string $message, int $code = null, array $data = [])
    {
        (empty($code) || $code == 0) ? http_response_code(400) : http_response_code($code);
        header('Content-type: application/json');
        return json_encode([
            'status' => http_response_code(),
            'message' => $message ?? 'Request failed',
            'data' => $data
        ], http_response_code());
    }

}