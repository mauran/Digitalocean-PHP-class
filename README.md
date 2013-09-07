Digital Ocean PHP class
============
This is an unofficial wrapper for the Digital Ocean API. This is too my first experimence with OOP PHP. Feel free to use my class or to send a pull request. :)

Example code
-------
```php

require("digitalocean.class.php");

$droplet = new droplet("CLIENT_ID","API_KEY");

$listing = $droplet->listing();

print_r($listing)

```
