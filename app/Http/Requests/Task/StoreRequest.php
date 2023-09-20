<?php

namespace App\Http\Requests\Task;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|unique:tasks,title,NULL,id,project_id,' . $this->project_id,
            'description' => 'sometimes|string',
            'start_time' => 'required|date|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date|date_format:Y-m-d H:i:s',
            'status' => ['sometimes', Rule::in([StatusEnum::PENDING, StatusEnum::IN_PROGRESS, StatusEnum::COMPLETE])],

        ];
    }

}
