<?php

namespace CeddyG\ClaraPageBuilder\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraPageBuilder\Repositories\PageRepository;

class PageController extends Controller
{
    public function show(PageRepository $oRepository, $sSlug)
    {
        $oPage = $oRepository->getFillFromView('abricot/page/show')
            ->findByField('url_page', $sSlug)
            ->first();
        
        if ($oPage !== null)
        {
            $sTitlePage = $oPage->title_page;

            return view('clara-page::show', compact('oPage', 'sTitlePage'));
        }
        else
        {
            abort(404);
        }
    }
}
