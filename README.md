DigitalOcean PHP class
============
This is a PHP class for the DigitalOcean API. This is also my first experience with OOP PHP. Feel free to use my class or to send a pull request. :smile:

Example code
-------
```php
include('digitalocean.class.php');
$servers = new digitalOcean('CLIENT_ID', 'API_KEY');


// Get all droplets
print_r( $servers->droplets() );


// Checkout droplet
print_r( $servers->checkoutDroplet(1000) );
print_r( $servers->checkoutDroplet(1001) );


// Get all sizes
print_r( $servers->sizes() );
// Validate size
var_dump( $servers->validateSize(60) );
// Validate size
var_dump( $servers->validateSize(10101010101010) );


// Get all images
print_r( $servers->images() );
// Validate image
var_dump( $servers->validateImage(682275) );
// Validate image
var_dump( $servers->validateImage(10101010101010) );
```