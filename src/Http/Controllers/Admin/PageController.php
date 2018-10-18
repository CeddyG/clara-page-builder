<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectTemplateAjax(Request $oRequest)
    {
        $this->oRepository->setReturnCollection(false);
        return $this->oRepository->select2($oRequest->all(), [['template', '=', 1]]);
    }
    
    public function showTemplateAjax($iIdTemplate)
    {
        $oPage = $this->oRepository->find($iIdTemplate, ['content_page']);
        
        return new JsonResponse(['content' => $oPage->content_page]);
    }
}
