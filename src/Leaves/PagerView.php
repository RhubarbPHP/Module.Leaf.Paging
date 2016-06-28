<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Leaf\Paging\Leaves;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Leaf\Views\View;

class PagerView extends View
{
    /**
     * @var PagerModel
     */
    protected $model;

    /**
     * @var int  The number of pages around the boundaries to show before hiding page links in favour of an ellipsis
     */
    public $bufferPages = 3;

    public function printViewContent()
    {
        // Don't show any pages if there only is one page.
        if ($this->model->numberOfPages <= 1) {
            return;
        }

        $pages = [];
        $stub = $this->model->leafPath;
        $request = Request::current();

        $iteration = 0;
        $class = 'first';
        while ($iteration < $this->model->numberOfPages) {
            $pageNumber = $iteration + 1;

            if ($pageNumber > $this->bufferPages && $pageNumber < $this->model->pageNumber - $this->bufferPages) {
                // If we're past the first few pages but are still a few pages before our selected page
                // and there is more than 1 page number to hide, show an ellipsis instead and skip forward
                $pages[] = '<span class="pager-buffer">&hellip;</span>';
                $iteration = $this->model->pageNumber - $this->bufferPages;
                continue;
            }
            if ($pageNumber < $this->model->numberOfPages - $this->bufferPages && $pageNumber > $this->model->pageNumber + $this->bufferPages - 1) {
                // If we're earlier than the last few pages but are a few pages after our selected page
                // and there is more than 1 page number to hide, show an ellipsis instead and skip forward
                $pages[] = '<span class="pager-buffer">&hellip;</span>';
                $iteration = $this->model->numberOfPages - $this->bufferPages;
                continue;
            }

            if ($pageNumber == $this->model->pageNumber) {
                $class .= ' selected';
            }

            $class .= ' pager-item';

            $class = ' class="' . trim($class) . '"';

            $pages[] = '<a href="' . $request->Uri . '?' . $stub . '-page=' . $pageNumber . '"' . $class . ' data-page="' . $pageNumber . '">' . $pageNumber . '</a>';

            $class = '';

            $iteration++;
        }

        print "<div class=\"pager\"><div class=\"pages\">" . implode("", $pages) . "</div></div>";
    }
}
