<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->createCustomer() : $this->updateCustomer() ;
    }

    public function createCustomer()
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    public function updateCustomer()
    {
        return [
            'name' => 'required|min:3',
        ];
    }
}
