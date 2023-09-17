<?php

namespace App\Http\Requests\V1;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResumeReviewRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if(User::current()->isUser()) {
            return [
                'resume' => ['required','file', 'mimes:pdf,doc,docx', 'max:2048'],
                'reviewer' => ['required', 'exists:users,id'],
                'job_titles' => ['nullable', 'string']
            ];
        }else {
            return [
                'summary' => ['required', 'string'],
                'remark' => ['array', 'required'],
            ];
        }
    }
}
