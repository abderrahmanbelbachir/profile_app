<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsCount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrganizationRequest extends FormRequest
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
            'organizations.*.start_date' => 'required|Date',
            'organizations.*.end_date' => 'required|Date',
            'organizations.*.associated_as' => 'required|string|max:255',
            'organizations.*.organization' => 'required|string|max:255',
            'organizations.*.current_job' => 'required|boolean',
            'organizations.*.description' => [
                'required',
                new MaxWordsCount(300)
            ],
        ];
    }
}
