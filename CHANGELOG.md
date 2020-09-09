# Changelog

### 1.2.0

Change: Pager no longer tries to calculate the page count in setCollection(). This was firing many
        times and often before any filters had been attached causing extreme performance degredation
        in some cases.

### 1.1.4

Fixed:  Issue with pager resetting range to 0 on before render

### 1.1.3

Fixed:  1.1.2 broke paging...

### 1.1.2

Fixed:  Fixed issue with pager not updating properly if other events updated the collection

### 1.1.1

Fixed:  Performance issue where event pager was counting pages even if never shown.

### 1.1.0

Added:  Storing page in URL state

### 1.0.3

Fixed:  Issue where the PageChanged Event was not being raised

### 1.0.2

Fixed:  Issue with Pager not using Ajax to rerender the view

### 1.0.1

Added:  CSS Flexibility to enable classes to be overridden

### 1.0.0

Added:      Changelog
