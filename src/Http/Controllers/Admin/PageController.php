<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use CeddyG\ClaraPageBuilder\Repositories\PageRepository;

class PageController extends ContentManagerController
{
    public function __construct(PageRepository $oRepository)
    {
        $this->sPath            = 'clara-page::admin.page';
        $this->sPathRedirect    = 'admin/page';
        $this->sName            = __('clara-page::page.page');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraPageBuilder\Http\Requests\PageRequest';
    }
}
