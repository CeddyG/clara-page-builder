<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class PageCategoryTextRepository extends QueryBuilderRepository
{
    protected $sTable = 'page_category_text';

    protected $sPrimaryKey = 'id_page_category_text';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page_category'
    ];

    protected $aFillable = [
        'fk_page_category',
        'name_page_category'
    ];
    
   
    public function page_category()
    {
        return $this->belongsTo('CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository', 'fk_page_category');
    }


}
