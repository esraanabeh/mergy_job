<?php

namespace App\Http\Requests;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'uid' => 'required|string|unique:jobs,uid',
            'name' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'email' => 'required|unique:jobs,email',
            'job' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'image' => 'required|image|mimes:png,jpg,gif',
            'cv' => 'required|mimes:pdf,docx',
            'password' => 'required',
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
