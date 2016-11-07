# itemlist_manager

Wish list manager

A simple example of WishList management with API functionality.

## Requirement

PHP 5.6
Composer 1.2

## Usage

- To initialize the project, the packages have to be installed,

```
$ composer install
```

- Import the SQL file `items_list.sql` into `items_list` database, confirm configuration in `conf.php`

- Opening URL at : ```http://localhost:8080/itemlist_manager/itemlist``` opens a GUI for Wish items management.


## API Usage

- Show all items with GET request at:

```
http://localhost:8080/itemlist_manager/items
```

- Show one item with ID with GET request at:

```
http://localhost:8080/itemlist_manager/items/1
```

- Create new item with POST request at:
 
 ```
 http://localhost:8080/itemlist_manager/items
 ```
 
 - Delete item with ID with DELETE request at:

```
http://localhost:8080/itemlist_manager/items/1
```

 - Update item with ID with PUT request at:

 ```
 http://localhost:8080/itemlist_manager/items/1
 ```
 
 