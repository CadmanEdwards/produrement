<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
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
            'company_type' => 'required',
            'company_name' => 'required',
			'cnic_number' => 'required',
            'ntn_number' => 'required',
            'registered_address' => 'required',
            'delivery_address' => 'required',
            'landline_number' => 'required',
        ];
    }
}
