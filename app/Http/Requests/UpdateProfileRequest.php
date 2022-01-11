<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsCount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
        $id = Auth::user()->id;
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'experiences.*.start_date' => 'required|Date',
            'experiences.*.end_date' => 'required|Date',
            'experiences.*.role' => 'required|string|max:255',
            'experiences.*.company' => 'required|string|max:255',
            'experiences.*.description' => [
                'required',
                new MaxWordsCount(300)
            ],

            'organizations.*.start_date' => 'required|Date',
            'organizations.*.end_date' => 'required|Date',
            'organizations.*.associated_as' => 'required|string|max:255',
            'organizations.*.organization' => 'required|string|max:255',
            'organizations.*.description' => [
                'required',
                new MaxWordsCount(300)
            ],
        ];
    }
}
