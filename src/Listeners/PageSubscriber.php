<?php

namespace CeddyG\ClaraPageBuilder\Listeners;

use CeddyG\ClaraPageBuilder\Repositories\PageRepository;

class PageSubscriber
{
    private $oRepository;
    
    public function __construct(PageRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function unsync($oEvent)
    {
        $this->oRepository->update($oEvent->id, ['page_trans' => []]);
        $this->oRepository->update($oEvent->id, ['page_trans_parent' => []]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraPageBuilder\Events\Page\BeforeDestroyEvent',
            'CeddyG\ClaraPageBuilder\Listeners\PageSubscriber@unsync'
        );
    }
}
