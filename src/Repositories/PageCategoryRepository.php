<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;
use ClaraLang;

class PageCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'page_category';

    protected $sPrimaryKey = 'id_page_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page',
        'active_page',
        'page_category_text',
        'page_category_trans'
    ];

    protected $aFillable = [
        'enable_page_category'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'title_page_category' => [
            'page_category_trans.name_page_category'
        ]
    ];
    
    protected $bTimestamp = true;
   
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
                'enable_page' => 1
            ]
        );
    }

    public function page_category_text()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageCategoryTextRepository', 'fk_page_category');
    }

    public function page_category_trans()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageCategoryTextRepository', 'fk_page_category', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
    
    public function getTitlePAgeCategoryAttribute($oItem)
    {
        return $oItem->page_category_trans->first()->name_page_category;
    }
}
