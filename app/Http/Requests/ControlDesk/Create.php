<?php

namespace App\Http\Requests\ControlDesk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Create extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'glp' => 'required|string',
            'plu' => 'nullable|string',
            'pso' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $allowedRanges = [
                        range(300, 315),
                        range(400, 415),
                        range(500, 505)
                    ];
                    $isValid = false;
                    foreach ($allowedRanges as $range) {
                        if (in_array($value, $range)) {
                            $isValid = true;
                            break;
                        }
                    }
                    if (!$isValid) {
                        $fail('The ' . $attribute . ' must be within the ranges 300-315, 400-415, or 500-505.');
                    }
                }
            ],
            'pre' => 'required|integer|digits_between:3,6',
            'dep' => 'nullable|string|size:2|default:LM',
            'pis' => 'nullable|string|size:3|default:PER',
            'image' => 'nullable|file'
        ];
    }
}
