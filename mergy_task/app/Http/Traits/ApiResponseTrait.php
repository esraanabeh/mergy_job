<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * Trait ApiResponseTrait
 * @author Ahmed Mohamed
 */
trait ApiResponseTrait
{
    /**
     * @param null $message
     * @param null $data
     * @param int $code
     * @param null $errors
     * @param null $token
     * @return JsonResponse
     */
    public function apiResponse(
        $message = null,
        $data = null,
        int $code = 200,
        $errors = null,
        $token = null
    ): JsonResponse
    {
        $response = [
            'message' => $message,
            'errors'  => $errors ?? 'None',
            'data'    => $data ?? 'None'
        ];

        if ($token) $response = array_merge($response, ['token' => $token]);

        return response()->json($response, $code);
    }

    /**
     * This function apiResponseValidation for Validation Request
     * @param $validator
     */
    public function apiResponseValidation($validator)
    {
        $response = $this->apiResponse('Invalid data send', '', 422, $validator->errors()->first());
        throw new HttpResponseException($response);
    }
}
