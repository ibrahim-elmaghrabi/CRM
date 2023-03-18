<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends ApiRequest
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
         return $this->isMethod('POST') ? $this->createProject() : $this->updateProject() ;
    }

    public function createProject()
    {
        return [
            'name' => 'required',
            'status' => 'required',
            'cost' => 'required',
        ];
    }

    public function updateProject()
    {
        return [
            'name' => 'sometimes|required|string',
            'status' => 'sometimes|required',
            'cost' => 'sometimes|required',
        ];
    }
}
