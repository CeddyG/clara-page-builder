<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository;

class PageCategoryController extends ContentManagerController
{
    protected $sEventBeforeStore    = \CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeStoreEvent::class;
    protected $sEventAfterStore     = \CeddyG\ClaraPageBuilder\Events\PageCategory\AfterStoreEvent::class;
    protected $sEventBeforeUpdate   = \CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeUpdateEvent::class;
    protected $sEventAfterUpdate    = \CeddyG\ClaraPageBuilder\Events\PageCategory\AfterUpdateEvent::class;
    protected $sEventBeforeDestroy  = \CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeDestroyEvent::class;
    
    public function __construct(PageCategoryRepository $oRepository)
    {
        $this->sPath            = 'clara-page::admin.page-category';
        $this->sPathRedirect    = 'admin/page-category';
        $this->sName            = __('clara-page::page-category.page_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraPageBuilder\Http\Requests\PageCategoryRequest';
    }
}
