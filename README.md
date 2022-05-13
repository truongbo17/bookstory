## Bookstory - All in free

* Config crawl in `config/crawl.php`

* Config `.env`

```
BACKPACK_REGISTRATION_OPEN=false
DRIVER_BROWSER=guzzle
ELASTIC_MIGRATIONS_CONNECTION=mysql
SCOUT_PREFIX=bs_
ELASTIC_HOST=localhost:9200
```

*  Imagick and Ghostscript installed 

``` 
php artisan storage:link
```
``` 
php artisan scout:import "App\Models\Document"
```
``` 
php artisan scout:import "App\Models\SeoKeyword"
```
