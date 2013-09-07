Digital Ocean PHP class
============
This is an class for the Digital Ocean API. This is too my first experience with OOP PHP. Feel free to use my class or to send a pull request. :-)

Example code
-------
```php
include('digitalocean.class.php');
$droplet = new droplet("CLIENT_ID", "API_KEY", "DROPLET_ID");


print_r( $droplet->listing() );
print_r( $droplet->checkout() );


$droplet->setId(1000);
print_r( $droplet->checkout() );
```