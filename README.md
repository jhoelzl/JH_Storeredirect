# JH_Storeredirect
Redirects Magento store view urls (e.g. from search engine result page) to the correct store view, otherwise standard 404 magento error

## Installation
* Install the extension via GitHub, [Composer](https://getcomposer.org/), [modman](https://github.com/colinmollenhour/modman) or a similar method. 
* Clear the cache, logout from the admin panel and then login again.
* Enable/Disable redirection in Magento Backend under System > Configuration > JH Modules > Store Redirect.

## Known Issues
* When you have a custom Magento Backend URL, maybe you have to exclude this URL in Observer.php on Line 11.
* Also investigate and test the behaviour of your shop carefully. Maybe some unwanted redirections are performed.


## Support
A Issue Request in this repository

## Improvements 
Feel free to make a pull request when you have ideas for improving.
