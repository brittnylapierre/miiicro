# Miiicro

Currently under development.

An instance of the [Microweber](https://github.com/microweber/microweber) drag and drop CMS that includes IIIF modules.

Todo list:
- [ ] Blacklight Search Bar Module
- [ ] Blacklight Search Results Module
- [ ] IIIF Universal Viewer Module
- [ ] IIIF Collection Explorer Module
- [ ] IIIF Collection Preview Module
- [ ] IIIF Metadata Viewer Module
- [ ] IIIF Citation Generation Module
- [ ] IIIF Mirador Workstation Module
- [ ] IIIF Clover Viewer Module
- [ ] IIIF Annotation Studio Module
- [ ] IIIF Manifest JSON CMS/IIIF Manifest Editor Admin Module - add option to select from/search in this list to previous modules. 
- [ ] iframe module


## Blacklight Search Bar Module


Options: 

Results page = one of the pages from your site - must have search results module 

Description:

Forwards to results page with qs param set to search input value



## Blacklight Search Results Module

Options: 

Blacklight url 

Description:

On load, javascript sends blacklight api request: <Blacklight url>/catalog.atom?q=<qs search input param from redirect>&content_format=oai_dc_xml
Example response: https://demo.projectblacklight.org/catalog.atom?q=urdu&content_format=oai_dc_xml
    

## IIIF Universal Viewer Module

Options: 

IIIF Presentation API url = ""
Get id from: query string 'manifesr_id' param OR enter manually (shows input)

Description:
On load
<script>
    universal viewer inititalization (pho print <Presentation API URL>/<manifest id>/manifest
</script>

Note: clover viewer to use same config


## IIIF Collection Explorer Module

Options: 

IIIF Presentation API url = ""
Enter collection ids manually
Layout: Grid, Slider, Pagination
Paginate?
    # per page

    
Description:
Will draw the manually entered collections in the selected layout
    
## IIIF Collection Preview Module

Options: 

IIIF Presentation API url = ""
Collection ID
Enter manifest ids manually
Layout: Grid, Slider, Pagination
Paginate?
    # per page

    
Description:
Will draw the manually entered manifests from the collection in the selected layout
    

## IIIF Metadata Module

Options: 

IIIF Presentation API url = ""
item type
item id
included feilds = metadata keynames to include - all OR list

    
Description:
Will draw the metadata feilds for the item in a table
  

## IIIF Citation Module

Options: 

IIIF Presentation API url = ""
item type
item id

    
Description:
Will draw citations in common citation formats for the item

## Others    
Clover viewer works exactly like universal viewer module
Mirador and annotation will work as stand alone allowing users to enter manifest urls
CMS: Digirati Manifest editor -> save json to system -> other modules can access json for manifests
    

    

### Possible Architectures

![Frame 1 (1)](https://user-images.githubusercontent.com/10541019/174935103-33ce8f3d-9b71-43ed-9f1a-3eadbe8e4db8.png)



## Built using Microweber: Drag-and-Drop CMS

Microweber is a Drag and Drop website builder and a powerful next generation CMS. It's based on the PHP Laravel Framework. You can use Microweber to make any kind of website, online store, and blog. The Drag and Drop technology allows you to build your website without any technical knowledge.

![Drag And Drop](https://microweber.com/cdn/2019_version/Drag_Drop_CMS_Microweber.gif "")
    
[Learn More](https://microweber.org/academy)


###  Requirements  

* HTTP server  
* Database server
* PHP >= 7.4
  * `lib-xml` must be enabled (with DOM support)
  * `GD` PHP extension


#### File permissions
Make sure these folders, and everything inside, is writeable by the user executing the PHP scripts:
* config/
* storage/
* userfiles/

#### Apache
The `mod_rewrite` module must be enabled in your Apache configuration. Microweber creates the necessary `.htaccess` files during installation, including one with `Deny All` directive in each folder to ensure that there are no entry points other than `index.php`.

#### nginx
Add this `location` directive to your `server` configuration block. The `root` directive must point to the base folder of your Microweber website (which by default is where this readme is located).
```
server {
  location / {
    try_files $uri $uri/ /index.php$is_args$args;
  }
  location ~ /(vendor|src|config|storage|.git|.env) {
   deny all;
   return 404;
 }
}

```

#### IIS

You can easily [import the `.htaccess` rewrite rules](http://www.iis.net/learn/extensions/url-rewrite-module/importing-apache-modrewrite-rules). Make sure you have enabled [the URL Rewrite module](http://www.iis.net/learn/extensions/url-rewrite-module/using-the-url-rewrite-module) for your website.

#### Database
You have several choices for database engine: MySQL, SQLite, Microsoft SQL Server and PostgreSQL.
For small websites we highly recommend SQLite.
However, you can connect to more storage services (like [MongoDB](https://github.com/jenssegers/laravel-mongodb) or [Neo4j](https://github.com/Vinelab/NeoEloquent)) and take advantage of the Laravel framework.

On the installation screen you can only choose from databases enabled in your PHP configuration.
If you don't see your server of choice in the list you have to enable the corresponding [PDO](http://php.net/manual/en/book.pdo.php) extension for your database server. [An example for Microsoft SQL Server](http://php.net/manual/en/mssql.installation.php). PHP usually comes with PDO enabled by default but you might have to uncomment or add `extension` directives to your `php.ini`.


### Installation  

Clone this repo!



### Dependencies

You need to [have Composer installed](https://getcomposer.org/doc/00-intro.md) in order to download Microweber's dependencies.

You can clone and install Microweber with one command:

```
composer create-project microweber/microweber my_site dev-master --prefer-dist --no-dev
```


This will install Microweber in a folder named `my_site`.

Another way is to first clone the repository and then run `composer install` in the base directory.



### Developer Guide

See the [online guides](http://microweber.com/docs/guides/README.md) for developers.

![Give a star to Microweber](https://microweber.com/cdn/2019_version/Star-Microweber.gif "")
