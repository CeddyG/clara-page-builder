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
        'page_trans',
        'page_trans_parent',
		'users'
    ];

    protected $aFillable = [
        'fk_page_category',
        'fk_users',
        'fk_lang',
        'title_page',
        'meta_title_page',
        'url_page',
        'enable_page',
        'content_page',
        'description_page',
        'css_page',
        'js_page'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'lang' => [
            'fk_lang',
            'url_page',
            'page_trans.fk_lang',
            'page_trans.url_page'
        ]
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
   
    public function page_trans_parent()
    {
        return $this->belongsToMany('CeddyG\ClaraPageBuilder\Repositories\PageRepository', 'page_trans', 'fk_trans', 'fk_page');
    }

    public function users()
    {
        return $this->belongsTo('CeddyG\ClaraSentinel\Repositories\UsersRepository', 'fk_users');
    }
    
    public function getContentPageAttribute($oItem)
    {
        if (config('clara.page.bootstrap', 3) == 4)
        {
            $oItem->content_page = str_replace('col-xs-', 'col-', $oItem->content_page);
            
            $oItem->content_page = str_replace('col-xs-offset', 'offset', $oItem->content_page);
            $oItem->content_page = str_replace('col-sm-offset', 'offset-sm', $oItem->content_page);
            $oItem->content_page = str_replace('col-md-offset', 'offset-md', $oItem->content_page);
            $oItem->content_page = str_replace('col-lg-offset', 'offset-lg', $oItem->content_page);
        }
        
        return $oItem->content_page;            
    }
    
    public function getLangAttribute($oItem)
    {
        $aLangs[config('clara.lang.iso')[$oItem->fk_lang]] = $oItem->url_page;
        
        foreach ($oItem->page_trans as $oPage)
        {
            $aLangs[config('clara.lang.iso')[$oPage->fk_lang]] = $oPage->url_page;
        }
        
        return $aLangs;
    }
}
