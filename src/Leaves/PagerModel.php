<?php

namespace Rhubarb\Leaf\Paging\Leaves;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;

class PagerModel extends LeafModel
{
    public $perPage;

    public $pageNumber = 1;

    public $numberOfPages;
    
    public $suppressContent = false;

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