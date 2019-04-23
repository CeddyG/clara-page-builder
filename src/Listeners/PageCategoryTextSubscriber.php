<?php

namespace CeddyG\ClaraPageBuilder\Listeners;

use CeddyG\ClaraPageBuilder\Repositories\PageCategoryTextRepository;

class PAgeCategoryTextSubscriber
{
    private $oRepository;
    
    public function __construct(PageCategoryTextRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraPageBuilder\Http\Requests\PageCategoryTextRequest');
    }

    public function store($oEvent) 
    {
        $aInputs = $oEvent->aInputs['page_category_text'];
        
        foreach ($aInputs as $iIdLang => $aInput)
        {
            $aInput['fk_lang']  = $iIdLang;
            $aInput['fk_page_category']   = $oEvent->id;
            
            $this->oRepository->updateOrCreate(
                [
                    ['fk_lang', '=', $iIdLang],
                    ['fk_page_category', '=', $oEvent->id]
                ], 
                $aInput
            );
        }
    }
    
    public function delete($oEvent)
    {
        $this->oRepository->deleteWhere([['fk_page_category', '=', $oEvent->id]]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeStoreEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\PageCategory\AfterStoreEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeUpdateEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber@validate'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\PageCategory\AfterUpdateEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\PageCategory\BeforeDestroyEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber@validate'
        );
    }
}
