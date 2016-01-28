# JH_Storeredirect

When you are using Magento Store Views as languages for your Magento shop you probably experiencing 404 error pages when you try to open an URL from another store view. By default, Magento routes the request to a 404 error page in the current active store view. This is a major problem when your localized store view URLs are indexed by search engines oder other systems.

This small extension simply redirects Magento request URLs (e.g. from search engine result page) to the correct (or best matching) store view and bypasses the standard 404 magento error pag.e

## Installation
* Install the extension via GitHub, [Composer](https://getcomposer.org/), [modman](https://github.com/colinmollenhour/modman) or a similar method. 
* Clear the cache, logout from the admin panel and then login again.
* Enable/Disable redirection in Magento Backend under System > Configuration > JH Modules > Store Redirect.

## Known Issues
* When you have a custom Magento Backend URL, maybe you have to exclude this URL in Observer.php on Line 11.
* Also investigate and test the behaviour of your shop carefully. Maybe some unwanted redirections are performed.


## Improvements 
Feel free to make a pull request when you have ideas for improving.

## Uninstallation
 
 * Fia FTP: Remove all extension files from your Magento installation
 * Via modman: `modman remove JH_Storeredirect`
 * Via composer, remove the line of your composer.json related to `jh_storeredirect`
 * Optional: Remove entry with path "storeredirect/general/enable" from table core_config_data
