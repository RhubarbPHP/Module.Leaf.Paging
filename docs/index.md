Paging
======

The `Pager` component and its variants allow you to present a set of page numbers and register
to handle an event raised when the user selects a page number.

> Pager is currently designed to work with Stem Collections

## Pager

Pass the Pager a collection and when printed it will print the list of pages and allow to
handle the `pageChangedEvent`:


```php
class MyPageView extends View
{
    private $pager;
    
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $this->pager = new Pager($this->model->jobs, 25)    // 25 jobs 'per page'
        );
    }
    
    protected function printViewContent()
    {
        print $this->pager;
        
        // This will only print 25 jobs as the collection has now been 'ranged' by the pager.
        foreach($this->model->jobs as $job){
            print $job->JobTitle."<br/>";
        }
    }
}
```

Notice that in the example above we aren't actually handling the `pageChangedEvent`. While this
event is raised, the Pager will automatically restrict the collection it is given to the correct
range based on it's selected page number.

The event can be used to signal some other update on the page:

```php
class MyPageView extends View
{
    private $pager;
    
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $this->pager = new Pager($this->model->jobs, 25)    // 25 jobs 'per page'
        );
        
        $this->>pager->pageChangedEvent->attachHandler(function($page){
            // Yes.. this should be in the Leaf class - putting here for brevity
            $this->model->onDifferentPage = true;
        });
    }
    
    protected function printViewContent()
    {
        if ($this->model->onDifferentPage){
            print '<h3>You changed the page!</h3>';
        }
        
        print $this->pager;
        
        // This will only print 25 jobs as the collection has now been 'ranged' by the pager.
        foreach($this->model->jobs as $job){
            print $job->JobTitle."<br/>";
        }
    }
}
```

If the collection only contains 1 page of items the pager will not appear at all.

When the user clicks on a page, a normal GET navigation occurs to the same URL but with
a query string that identifies the page number for the correct pager. 

### Controlling the view

The standard output can be controlled by extending the PagerView and modifying a number of 
properties:

$bufferPages
:   The number of pages around the boundaries to show before hiding page links in favour of an ellipsis

$pageCssClass
:   The CSS class attached to every page link

$firstPageCssClass
:   The CSS class attached to the first page link

$selectedPageCssClass
:   The CSS class attached to the link for the currently rendered page

$pagerBufferCssClass
:   The CSS class attached to the elipsis container

$containerCssClass
:   The CSS class attached to the surrounding container

$innerContainerCssClass
:   The CSS class attached to the inner container

For more radical control you can simply override the printViewContent().

To replace all occurrences of the view register the new class using dependency injection. For a 
single occurrence you might consider extending the Pager leaf itself to allow you to select the
new view.

## FormPager

This extension of the `Pager` component changes the behaviour to put the selected page number into a hidden
input and submit the form when a user selects a page. This ensures the page is posted thus retaining
the state of all Leaves on the page.

This is most often used when the pager is present in a place where users may have entered
data that can't be lost if the user changes page.

## EventPager

This extension of the `Pager` component changes the behaviour to raise the page changed event
as an XHR server event instead of navigating with a GET operation.

This is mostly used in conjunction with re-rendering other components for a more application like feel.