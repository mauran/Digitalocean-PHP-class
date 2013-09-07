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

class droplet {

	private $client_id;
	private $api_key;

	function __construct($client_id = "", $api_key = "") 
	{

		$this->client_id = $client_id;
		$this->api_key = $api_key;

	}

		public function listing() 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function newdrop($droplet_name, $size_id, $image_id, $region_id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/new?client_id=".$this->client_id."&api_key=".$this->api_key."&name=".$droplet_name."&size_id=".$size_id."&image_id=".$image_id."&region_id=".$region_id),true);
		}

		public function id($id)
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function reboot($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/reboot/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function powercycle($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/power_cycle/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function shutdown($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/shutdown/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function kill($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/power_off/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function start($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/power_on/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function resetpw($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/password_reset/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function snapshot($id, $snapshot_name) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/snapshot/?name=".$snapshot_name."&client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function restore($id, $image_id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/restore/?image_id=".$image_id."&client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function rebuild($id, $image_id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/rebuild/?image_id=".$image_id."&client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function enbackup($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/enable_backups/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

		public function disbackup($id) 
		{
			return json_decode(file_get_contents("https://api.digitalocean.com/droplets/".$id."/disable_backups/?client_id=".$this->client_id."&api_key=".$this->api_key),true);
		}

}


// Cheers to example code //
$droplet = new droplet("CLIENT_ID","API_KEY");

$listing = $droplet->listing();

print_r($listing)


?>