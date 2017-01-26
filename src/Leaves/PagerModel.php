<?php

namespace Rhubarb\Leaf\Paging\Leaves;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\UrlStateLeafModel;

class PagerModel extends UrlStateLeafModel
{
    public $perPage;

    public $pageNumber = 1;

    public $numberOfPages;

    public $suppressContent = false;

    /**
     * @var string The name of the GET param which will provide state for this pager in the URL
     * If you have multiple pagers on a page and want URL state to apply to them all independently, you'll need to make this unique.
     * Set it to null to disable URL state for this pager.
     */
    public $urlStateName = 'page';

    /**
     * @var Event
     */
    public $pageChangedEvent;

    public function __construct()
    {
        parent::__construct();

        $this->pageChangedEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = "perPage";
        $properties[] = "pageNumber";

        return $properties;
    }
}
