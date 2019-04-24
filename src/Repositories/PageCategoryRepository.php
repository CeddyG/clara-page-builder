<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use ClaraLang;

class PageCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'page_category';

    protected $sPrimaryKey = 'id_page_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page',
        'active_page'
    ];

    protected $aFillable = [
        'enable_page_category'
    ];
   
    public function page()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageRepository', 'fk_page_category');
    }

    public function active_page()
    {
        return $this->hasMany(
            'CeddyG\ClaraPageBuilder\Repositories\PageRepository', 
            'fk_page_category', 
            [
                'enable_page' => 1,
                'template' => 0,
            ]
        );
    }

    public function page_category_text()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageCategoryTextRepository', 'fk_page_category');
    }

    public function text()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageCategoryTextRepository', 'fk_page_category', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
}
