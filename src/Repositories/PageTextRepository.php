<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class PageTextRepository extends QueryBuilderRepository
{
    protected $sTable = 'page_text';

    protected $sPrimaryKey = 'id_page_text';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page'
    ];

    protected $aFillable = [
        'fk_page',
        'fk_lang',
        'title_page',
        'url_page',
        'content_page',
        'description_page',
        'css_page',
        'js_page'
    ];
    
    protected $bTimestamp = true;
   
    public function page()
    {
        return $this->belongsTo('CeddyG\ClaraPageBuilder\Repositories\PageRepository', 'fk_page');
    }


}
