<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    abstract public function authorize() ;
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    abstract public function rules();

    public function failedValidation(Validator $validator)
    {
       $errors = (new ValidationException($validator))->errors();
       if (!empty($errors) )
       {
            $transformedErrors = [];
            foreach($errors as $field => $message)
            {
                $transformedErrors[] = [
                    $field => $message[0]
                ];

            }
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'errors' => $transformedErrors
                ],
                    JsonResponse::HTTP_BAD_REQUEST
                )
            );
            
        }
    }
     
}
