<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Question;

class SubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'respondent_name' => ['required', 'string', 'max:255'],
            'respondent_position' => ['required', 'string', 'max:255'],
            'opd_id' => ['required', 'exists:opds,id'],
            'respondent_phone' => ['required', 'string', 'regex:/^(\+62|62|0)[0-9]{8,13}$/'],
            'respondent_email' => ['nullable', 'email', 'max:255'],
        ];

        $questions = Question::active()->ordered()->get();

        foreach ($questions as $question) {
            $rules["answer_{$question->id}"] = ['required', 'exists:options,id'];
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'respondent_name.required' => 'Nama wajib diisi.',
            'respondent_position.required' => 'Jabatan wajib diisi.',
            'opd_id.required' => 'OPD wajib dipilih.',
            'opd_id.exists' => 'OPD tidak valid.',
            'respondent_phone.required' => 'No Telpon wajib diisi.',
            'respondent_phone.regex' => 'Format No Telpon tidak valid (contoh: 08123456789).',
            'respondent_email.email' => 'Format email tidak valid.',
        ];

        $questions = Question::active()->ordered()->get();

        foreach ($questions as $question) {
            $messages["answer_{$question->id}.required"] = "Jawaban untuk {$question->code} wajib dipilih.";
            $messages["answer_{$question->id}.exists"] = "Jawaban untuk {$question->code} tidak valid.";
        }

        return $messages;
    }
}
