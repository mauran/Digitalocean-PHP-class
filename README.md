DigitalOcean PHP class
============
This is an class for the Digital Ocean API. This is too my first experience with OOP PHP. Feel free to use my class or to send a pull request. :)

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