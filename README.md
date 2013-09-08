DigitalOcean PHP class
============
This is a PHP class for the DigitalOcean API. This is also my first experience with OOP PHP. Feel free to use my class or to send a pull request. :smile:

Example code
-------
```php
include('digitalocean.class.php');
$servers = new digitalOcean("CLIENT_ID", "API_KEY", "DROPLET_ID");


print_r( $servers->listing() );
print_r( $servers->checkout() );


$servers->setId(1000);
print_r( $servers->checkout() );
```
