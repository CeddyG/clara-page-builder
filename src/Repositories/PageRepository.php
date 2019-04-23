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
		'template',
		'enable_page'
    ];
    
   
    public function page_category()
    {
        return $this->belongsTo('CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository', 'fk_page_category');
    }

    public function users()
    {
        return $this->belongsTo('CeddyG\ClaraSentinel\Repositories\UsersRepository', 'fk_users');
    }

    public function page_text()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageTextRepository', 'fk_page');
    }

    public function text()
    {
        return $this->hasMany('CeddyG\ClaraPageBuilder\Repositories\PageTextRepository', 'fk_page', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
}
