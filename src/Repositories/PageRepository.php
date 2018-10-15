<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class PageRepository extends QueryBuilderRepository
{
    protected $sTable = 'page';

    protected $sPrimaryKey = 'id_page';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page_category',
		'users'
    ];

    protected $aFillable = [
        'fk_page_category',
		'fk_users',
		'title_page',
		'url_page',
		'template',
		'content_page',
		'enable_page'
    ];
    
   
    public function page_category()
    {
        return $this->belongsTo('CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository', 'fk_page_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Repositories\UsersRepository', 'fk_users');
    }
}
