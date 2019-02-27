<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraPageBuilder\Repositories\PageCategoryRepository;

class PageCategoryController extends ContentManagerController
{
    public function __construct(PageCategoryRepository $oRepository)
    {
        $this->sPath            = 'clara-page::admin.page-category';
        $this->sPathRedirect    = 'admin/page-category';
        $this->sName            = __('clara-page::page-category.page_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraPageBuilder\Http\Requests\PageCategoryRequest';
    }
}
