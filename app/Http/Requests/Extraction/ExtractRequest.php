<?php

namespace App\Http\Requests\Extraction;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class ExtractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|file|mimetypes:image/png,image/jpeg,image/jpg|max:5120',
        ];
    }
}
