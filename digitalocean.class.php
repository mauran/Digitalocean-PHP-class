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
	private $baseurl = 'https://api.digitalocean.com';

	private $clientId;
	private $apiKey;


	/**
	* Construct our class
	*/

	function __construct($clientId, $apiKey)
	{
		$this->clientId = $clientId;
		$this->apiKey = $apiKey;
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
		$response = file_get_contents($this->baseurl . $file . '/?' . $parameters);


		// Decode JSON
		$response = json_decode($response, true);


		// Return answer
		return $response;
	}




	/**
	* Droplets
	*/

	public function droplets()
	{
		return self::request('/droplets');
	}

	public function newDroplet($name, $sizeId, $imageId, $regionId)
	{
		// Validate informations
		if(self::validateSize($sizeId) == false) {
			return false;
		}elseif(self::validateImage($imageId) == false) {
			return false;
		}elseif(self::validateRegion($regionId) == false) {
			return false;
		}else{

			$parameters = array('name' => $name, 'size_id' => $sizeId, 'image_id' => $imageId, 'region_id' => $regionId);
			return self::request('/droplets/new', $parameters);

		}
	}

	public function checkoutDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId);
	}

	public function rebootDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/reboot');
	}

	public function powerCycleDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/power_cycle');
	}

	public function shutdownDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/shutdown');
	}

	public function powerOffDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/power_off');
	}

	public function powerOnDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/power_on');
	}

	public function resetPasswordDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/password_reset');
	}

	public function resizeDroplet($dropletId, $sizeId)
	{
		if(self::validateSize($sizeId) == false) {
			return false;
		}else{

			$parameters = array('size_id' => $sizeId);
			return self::request('/droplets/' . $dropletId . '/resize', $parameters);

		}
	}

	public function snapshotDroplet($dropletId, $name)
	{
		$parameters = array('snapshot_name' => $name);
		return self::request('/droplets/' . $dropletId . '/snapshot', $parameters);
	}

	public function restoreDroplet($dropletId, $imageId)
	{
		if(self::validateImage($imageId) == false) {
			return false;
		}else{

			$parameters = array('image_id' => $imageId);
			return self::request('/droplets/' . $dropletId . '/restore', $parameters);

		}
	}

	public function rebuildDroplet($dropletId, $imageId)
	{
		if(self::validateImage($imageId) == false) {
			return false;
		}else{

			$parameters = array('image_id' => $imageId);
			return self::request('/droplets/' . $dropletId . '/rebuild', $parameters);

		}
	}

	public function enableBackupDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/enable_backups');
	}

	public function disableBackupDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/disable_backups');
	}

	public function renameDroplet($dropletId, $name)
	{
		$parameters = array('name' => $name);
		return self::request('/droplets/' . $dropletId . '/rename', $parameters);
	}

	public function destroyDroplet($dropletId)
	{
		return self::request('/droplets/' . $dropletId . '/destroy');
	}

	public function validateDroplet($dropletId)
	{
		$found = false;

		$checkoutDroplet = self::checkoutDroplet($dropletId);

		if($checkoutDroplet['status'] == 'OK')
		{
			$found = true;
		}

		return $found;
	}




	/**
	* Regions
	*/

	public function regions()
	{
		return self::request('/regions');
	}

	public function validateRegion($regionId)
	{
		$found = false;

		$regions = self::regions();
		$regions = $regions['regions'];

		// Run through regions
		foreach($regions as $value)
		{
			if($value['id'] == $regionId)
				$found = true;
		}

		return $found;
	}




	/**
	* Images
	*/

	public function images($filter = '')
	{
		if($filter)
		{
			$parameters = array('filter' => $filter);
		}

		return self::request('/images', $parameters);
	}

	public function checkoutImage($imageId)
	{
		return self::request('/images/' . $imageId);
	}

	public function destroyImage($imageId)
	{
		return self::request('/images/' . $imageId . '/destroy');
	}

	public function transferImage($imageId)
	{
		return self::request('/images/' . $imageId . '/transfer');
	}

	public function validateImage($imageId)
	{
		$found = false;

		$checkoutImage = self::checkoutImage($imageId);

		if($checkoutImage['status'] == 'OK')
		{
			$found = true;
		}

		return $found;
	}




	/**
	* Sizes
	*/

	public function sizes()
	{
		return self::request('/sizes');
	}

	public function validateSize($sizeId)
	{
		$found = false;

		$sizes = self::sizes();
		$sizes = $sizes['sizes'];

		// Run through sizes
		foreach($sizes as $value)
		{
			if($value['id'] == $sizeId)
				$found = true;
		}

		return $found;
	}
}
?>