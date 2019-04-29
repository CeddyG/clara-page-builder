<?php

namespace CeddyG\ClaraPageBuilder\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;
use ClaraLang;

class PageRepository extends QueryBuilderRepository
{
    protected $sTable = 'page';

    protected $sPrimaryKey = 'id_page';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page_category',
        'page_trans',
		'users'
    ];

    protected $aFillable = [
        'fk_page_category',
        'fk_users',
        'fk_lang',
        'title_page',
        'url_page',
        'enable_page',
        'content_page',
        'description_page',
        'css_page',
        'js_page'
    ];
    
    protected $bTimestamp = true;    
   
    public function page_category()
    {
        return $this->belongsTo('CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository', 'fk_page_category');
    }
   
    public function page_trans()
    {
        return $this->belongsToMany('CeddyG\ClaraPageBuilder\Repositories\PageRepository', 'page_trans', 'fk_page', 'fk_trans');
    }

    public function users()
    {
        return $this->belongsTo('CeddyG\ClaraSentinel\Repositories\UsersRepository', 'fk_users');
    }
}
