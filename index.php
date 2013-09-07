<?php
include('digitalocean.class.php');
$servers = new digitalOcean("CLIENT_ID", "API_KEY", "DROPLET_ID");


print_r( $servers->listing() );
print_r( $servers->checkout() );


$servers->setId(1000);
print_r( $servers->checkout() );
?>