<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

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
    public function selectLang(Request $oRequest)
    {
        $this->oRepository->setReturnCollection(false);
        return $this->oRepository->select2($oRequest->all(), [['fk_lang', '=', $oRequest->all('fk_lang')]]);
    }
    
    public function showTemplateAjax($iIdTemplate)
    {
        $oPage = $this->oRepository->find($iIdTemplate, ['content_page']);
        
        return new JsonResponse(['content' => $oPage->content_page]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $oRequest)
    {
        if (!$oRequest->is('api/*'))
        {
            $oItem = $this->oRepository
                ->getFillFromView($this->sPath.'/form')
                ->find($id, ['page_category.id_page_category', 'page_category.title_page_category']);

            $sPageTitle = $this->sName;

            return view($this->sPath.'/form',  compact('oItem','sPageTitle'));
        }
        else
        {
            $aInput = $oRequest->all();
            
            if (array_has($aInput, 'column') && count($aInput['column']) > 0)
            {
                $aField = $aInput['column'];
            }
            else
            {
                $aField = ['*'];
            }
            
            $oItem = $this->oRepository
                ->find($id, $aField);
            
            return response()->json($oItem, 200);
        }        
    }
}
