<?php

namespace CeddyG\ClaraPageBuilder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageCategoryRequest extends FormRequest
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
            'id_page_category' => 'numeric',
            'name_page_category' => 'string|max:45',
            'enable_page_category' => 'numeric',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

