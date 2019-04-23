<?php

namespace CeddyG\ClaraPageBuilder\Listeners;

use CeddyG\ClaraPageBuilder\Repositories\PageTextRepository;

class PageTextSubscriber
{
    private $oRepository;
    
    public function __construct(PageTextRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraPageBuilder\Http\Requests\PageTextRequest');
    }

    public function store($oEvent) 
    {
        $aInputs = $oEvent->aInputs['page_text'];
        
        foreach ($aInputs as $iIdLang => $aInput)
        {
            $aInput['fk_lang']  = $iIdLang;
            $aInput['fk_page']   = $oEvent->id;
            
            $this->oRepository->updateOrCreate(
                [
                    ['fk_lang', '=', $iIdLang],
                    ['fk_page', '=', $oEvent->id]
                ], 
                $aInput
            );
        }
    }
    
    public function delete($oEvent)
    {
        $this->oRepository->deleteWhere([['fk_page', '=', $oEvent->id]]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\BeforeStoreEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageTextSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\AfterStoreEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\BeforeUpdateEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageTextSubscriber@validate'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\AfterUpdateEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\BeforeDestroyEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageTextSubscriber@validate'
        );
    }
}
