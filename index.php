<?php
include('digitalocean.class.php');
$droplet = new droplet("CLIENT_ID", "API_KEY", "DROPLET_ID");


print_r( $droplet->listing() );
print_r( $droplet->checkout() );


$droplet->setId(1000);
print_r( $droplet->checkout() );
?>