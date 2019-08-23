<?php

namespace CeddyG\ClaraPageBuilder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Sentinel;

class PageRequest extends FormRequest
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
    
    public function all($keys = null)
    {
        $aAttribute = parent::all($keys);
        
        if (Sentinel::check())
        {
            $aAttribute['fk_users'] = Sentinel::getUser()->id;
        }
        
        return $aAttribute;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_page' => 'numeric',
            'fk_page_category' => 'numeric',
            'fk_users' => 'numeric',
            'fk_lang' => 'numeric',
            'title_page' => 'string|max:150',
            'meta_title_page' => 'string|max:80',
            'url_page' => 'string|max:255',
            'enable_page' => 'numeric',
            'content_page' => '',
            'description_page' => '',
            'css_page' => '',
            'js_page' => '',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

