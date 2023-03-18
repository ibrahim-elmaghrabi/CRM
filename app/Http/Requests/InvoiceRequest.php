<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends ApiRequest
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
            return $this->isMethod('POST') ? $this->createInvoice() : $this->updateInvoice() ;

    }
        public function createInvoice()
        {
            return [
                'total' => 'required',
                'items' => 'required|array',
            ];
        }

        public function updateInvoice()
        {
             return [
                'total' => 'sometimes|required',
                'items' => 'sometimes|required|array',
                
            ];
        }
}
