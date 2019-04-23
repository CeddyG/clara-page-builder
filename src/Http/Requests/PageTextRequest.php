<?php

namespace CeddyG\ClaraPageBuilder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageTextRequest extends FormRequest
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
            'id_page_text' => 'numeric',
            'fk_page' => 'numeric',
            'fk_lang' => 'numeric',
            'title_page' => 'string|max:45',
            'url_page' => 'string|max:255',
            'content_page' => '',
            'description_page' => '',
            'css_page' => '',
            'js_page' => '',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

