<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends ApiRequest
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
        return $this->isMethod('POST') ? $this->createNote() : $this->updateNote();
    }

    public function createNote()
    {
        return [
            'note' => 'required',
        ];
    }

    public function updateNote()
    {
         return [
            'note' => 'required',
        ];
    }

}
