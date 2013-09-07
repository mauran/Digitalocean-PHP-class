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

class digitalOcean
{
	private $baseprot = 'https://';
	private $baseurl = 'api.digitalocean.com';
	private $clientId;
	private $apiKey;
	private $id;


	/**
	* Construct our class
	*/

	function __construct($clientId, $apiKey, $id)
	{
		$this->clientId = $clientId;
		$this->apiKey = $apiKey;
		$this->id = $id;
	}




	/**
	* Internal methods
	*/

	private function request($file, $parameters = null)
	{
		// Add client and api to parameters
		$parameters['client_id'] = $this->clientId;
		$parameters['api_key'] = $this->apiKey;


		// Build parameters
		$parameters = http_build_query($parameters);


		// Make request
		$response = file_get_contents($this->baseprot . $this->baseurl . $file . '/?' . $parameters);


		// Decode JSON
		$response = json_decode($response, true);


		// Return answer
		return $response;
	}


	public function setId($newId)
	{
		$this->id = $newId;
	}




	/**
	* DigitalOcean methods
	*/

	public function listing()
	{
		return self::request('/droplets');
	}

	public function newDroplet($name, $size, $image, $region)
	{
		$parameters = array('name' => $name, 'size_id' => $size, 'image_id' => $image, 'region_id' => $region);
		return self::request('/droplets/new', $parameters);
	}

	public function checkout()
	{
		return self::request('/droplets/' . $this->id);
	}

	public function reboot()
	{
		return self::request('/droplets/' . $this->id . '/reboot');
	}

	public function powerCycle()
	{
		return self::request('/droplets/' . $this->id . '/power_cycle');
	}

	public function shutdown()
	{
		return self::request('/droplets/' . $this->id . '/shutdown');
	}

	public function kill()
	{
		return self::request('/droplets/' . $this->id . '/power_off');
	}

	public function start()
	{
		return self::request('/droplets/' . $this->id . '/power_on');
	}

	public function resetPassword()
	{
		return self::request('/droplets/' . $this->id . '/password_reset');
	}

	public function snapshot($name)
	{
		$parameters = array('snapshot_name' => $name);
		return self::request('/droplets/' . $this->id . '/snapshot', $parameters);
	}

	public function restore($imageId)
	{
		$parameters = array('image_id' => $imageId);
		return self::request('/droplets/' . $this->id . '/restore', $parameters);
	}

	public function rebuild($imageId)
	{
		$parameters = array('image_id' => $imageId);
		return self::request('/droplets/' . $this->id . '/rebuild', $parameters);
	}

	public function enableBackup()
	{
		return self::request('/droplets/' . $this->id . '/enable_backups');
	}

	public function disableBackup()
	{
		return self::request('/droplets/' . $this->id . '/disable_backups');
	}
}
?>