<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'phone' => 'required|string',
            'email' => 'required|string',
            'instagram' => 'nullable|string',
            'company_info' => 'nullable|string',
            'working_hours' => 'nullable|string',
            'location_map' => 'nullable|string',
            'code' => 'nullable|string',
        ];
    }
}
