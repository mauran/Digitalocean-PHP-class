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
class droplets
{
	private $client_id;
	private $api_key;

	function __construct($client_id, $api_key)
	{
		$this->client_id = $client_id;
		$this->api_key = $api_key;
	}


	private function request($url, $parameters)
	{
		// Add client and api to parameters
		$parameters['client_id'] = $this->client_id;
		$parameters['api_key'] = $this->api_key;


		// Build parameters
		$parameters = http_build_query($parameters);


		// Make request
		$response = file_get_contents($url . '/?' . $parameters);


		// Decode JSON
		$response = json_decode($response, true);


		// Return answer
		return $response;
	}


	public function listing()
	{
		return self::request('https://api.digitalocean.com/droplets');
	}

	public function newDroplet($name, $size, $image, $region)
	{
		$parameters = array(
			'name' => $name,
			'size_id' => $size,
			'image_id' => $image,
			'region_id' => $region;
		);

		return self::request('https://api.digitalocean.com/droplets/new', $parameters);
	}

	public function checkout($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id);
	}

	public function reboot($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/reboot');
	}

	public function powerCycle($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/power_cycle');
	}

	public function shutdown($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/shutdown');
	}

	public function kill($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/power_off');
	}

	public function start($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/power_on');
	}

	public function resetPassword($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/password_reset');
	}

	public function snapshot($id, $name)
	{
		$parameters = array('snapshot_name' => $name);
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/snapshot', $parameters);
	}

	public function restore($id, $image_id)
	{
		$parameters = array('image_id' => $image_id);
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/restore', $parameters);

	}

	public function rebuild($id, $image_id)
	{
		$parameters = array('image_id' => $image_id);
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/rebuild', $parameters);
	}

	public function enableBackup($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/enable_backups');
	}

	public function disableBackup($id)
	{
		return self::request('https://api.digitalocean.com/droplets/' . $id . '/disable_backups');
	}
}
?>