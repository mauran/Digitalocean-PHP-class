<?php
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <mauran@mauran.me> wrote this file.
 * As long as you retain this notice you can do whatever you want with this
 * stuff. If we meet some day, and you think this stuff is worth it, you can
 * buy me a beer in return --Mauran Muthiah
 * ----------------------------------------------------------------------------
 */


Class digitalocean {

	private $client_id;
	private $api_key;

	function __construct()
	{
	$this->fisseMinister = 'Fogh knepper geder';
	 }

	public function droplets() 
	{
		return json_decode(file_get_contents("https://api.digitalocean.com/droplets/?client_id=[your_client_id]&api_key=[your_api_key]"),true);
	}

}


$notice = new digitalocean();
echo $notice->droplets;

print_r($notice);

?>