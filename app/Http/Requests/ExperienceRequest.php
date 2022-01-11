<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsCount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExperienceRequest extends FormRequest
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
            'experiences.*.start_date' => 'required|Date',
            'experiences.*.end_date' => 'required|Date',
            'experiences.*.role' => 'required|string|max:255',
            'experiences.*.company' => 'required|string|max:255',
            'experiences.*.current_job' => 'required|boolean',
            'experiences.*.description' => [
                'required',
                new MaxWordsCount(300)
            ]
        ];
    }
}
