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

	public function checkoutDroplet($id)
	{
		return self::request('/droplets/' . $id);
	}

	public function rebootDroplet($id)
	{
		return self::request('/droplets/' . $id . '/reboot');
	}

	public function powerCycleDroplet($id)
	{
		return self::request('/droplets/' . $id . '/power_cycle');
	}

	public function shutdownDroplet($id)
	{
		return self::request('/droplets/' . $id . '/shutdown');
	}

	public function powerOffDroplet($id)
	{
		return self::request('/droplets/' . $id . '/power_off');
	}

	public function powerOnDroplet($id)
	{
		return self::request('/droplets/' . $id . '/power_on');
	}

	public function resetPasswordDroplet($id)
	{
		return self::request('/droplets/' . $id . '/password_reset');
	}

	public function resizeDroplet($id, $sizeId)
	{
		if(self::validateSize($sizeId) == false) {
			return false;
		}else{

			$parameters = array('size_id' => $sizeId);
			return self::request('/droplets/' . $id . '/resize', $parameters);

		}
	}

	public function snapshotDroplet($id, $name)
	{
		$parameters = array('snapshot_name' => $name);
		return self::request('/droplets/' . $id . '/snapshot', $parameters);
	}

	public function restoreDroplet($id, $imageId)
	{
		if(self::validateImage($imageId) == false) {
			return false;
		}else{

			$parameters = array('image_id' => $imageId);
			return self::request('/droplets/' . $id . '/restore', $parameters);

		}
	}

	public function rebuildDroplet($id, $imageId)
	{
		if(self::validateImage($imageId) == false) {
			return false;
		}else{

			$parameters = array('image_id' => $imageId);
			return self::request('/droplets/' . $id . '/rebuild', $parameters);

		}
	}

	public function enableBackupDroplet($id)
	{
		return self::request('/droplets/' . $id . '/enable_backups');
	}

	public function disableBackupDroplet($id)
	{
		return self::request('/droplets/' . $id . '/disable_backups');
	}

	public function renameDroplet($id, $name)
	{
		$parameters = array('name' => $name);
		return self::request('/droplets/' . $id . '/rename', $parameters);
	}

	public function destroyDroplet($id)
	{
		return self::request('/droplets/' . $id . '/destroy');
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