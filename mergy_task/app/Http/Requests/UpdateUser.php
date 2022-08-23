<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
class UpdateUser extends FormRequest
{

    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uid' => 'required|string',
            'name' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'job' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'image' => 'required|image|mimes:png,jpg,gif',
            'cv' => 'required|mimes:pdf,docx',
        ];
    }

     /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->apiResponseValidation($validator);
    }
}
