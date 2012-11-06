<?php
/**
* Provide easy access to the pingomatic service
* @author Whit Marbut
* @copyright 2012 Dynamix Web Design, LLC
* @license Creative Commons Attribution-ShareAlike 3.0 Unported 
*/
class DxPingomatic {
	/**
	* array $properties properties hash for GET request to pingomatic
	* all checkbox properties are treated as boolean, but stored as 'on'/'off'
	*/
	protected $properties = array(
		'title' => '',
		'blogurl' => '',
		'rssurl' => '',
		'chk_weblogscom' => '',
		'chk_blogs' => '',
		'chk_feedburner' => '',
		'chk_newsgator' => '',
		'chk_myyahoo' => '',
		'chk_pubsubcom' => '',
		'chk_blogdigger' => '',
		'chk_weblogalot' => '',
		'chk_newsisfree' => '',
		'chk_topicexchange' => '',
		'chk_google' => '',
		'chk_tailrank' => '',
		'chk_skygrid' => '',
		'chk_collecta' => '',
		'chk_superfeedr'=> ''
	);

	/**
	* array $checkboxes List of properties that are checkboxes
	*/
	protected $checkboxes = array('chk_weblogscom', 'chk_blogs', 'chk_feedburner', 'chk_newsgator', 'chk_myyahoo', 'chk_pubsubcom', 'chk_blogdigger', 'chk_weblogalot', 'chk_newsisfree', 'chk_topicexchange', 'chk_google', 'chk_tailrank', 'chk_skygrid', 'chk_collecta', 'chk_superfeedr');


	/**
	* string $pingomatic_url the base url for the GET request
	*/
	private $pingomatic_url = 'http://pingomatic.com/ping/';

	/**
	* Construct an instance with the title, blogurl, and rssurl
	* @param string $title
	* @param string $blogurl
	* @param string $rssurl
	* @param boolean $check_all (optional - default false) would you like submit to all services?
	*/
	function __construct($title, $blogurl, $rssurl, $check_all = false) {
		$this->title = $title;
		$this->blogurl = $blogurl;
		$this->rssurl = $rssurl;
		if ($check_all) {
			$this->enableAllServices();
		}
	}

	/**
	* Notify all services (check all checkboxes)
	* @return void
	*/
	public function enableAllServices() {
		foreach ($this->checkboxes as $box) {
			$this->$box = true;
		}
	}

	/**
	* Notify no services (check no checkboxes)
	* @return void
	*/
	public function enableNoServices() {
		foreach($this->checkboxes as $box) {
			$this->$box = false;
		}
	}

	/**
	* Set a pingomatic value through the magic `__set` function. Keys map to the `properties`
	* hash.
	* @param mixed $key the name of the value to set. In this case will always be a string
	* @param mixed $value the value of the property
	* @return boolean true for success
	*/
	public function __set($key, $value) {
		if (array_key_exists($key,$this->properties)) {
			$this->properties[$key] = $value;
			switch($key) {
				case 'title':
					 $this->properties[$key] = $value;
					 break;
				case 'blogurl':
					 $this->properties[$key] = $value;
					 break;
				case 'rssurl':
					 $this->properties[$key] = $value;
					 break;
				default:
					 if (is_bool($value)) {
						$this->properties[$key] = $value;
					 } else {
						 $this->properties[$key] = ($value == 'on')? true : false;
					 }
					 break;
			}
			return true;
		}
		return false;
	}

	/**
	* Get a value for any of the pingomatic properties
	* @param mixed $key the property key
	* @return mixed the value of the property or false for failure
	*/
	public function __get($key) {
		if (array_key_exists($key, $this->properties)) {
			switch($key) {
				case 'title':
					return $this->properties[$key];
				case 'blogurl':
					return $this->properties[$key];
				case 'rssurl':
					return $this->properties[$key];
				default:
					return ($this->properties[$key] == 'on')? true : false;
			}
		}
		return false;
	}

	/**
	* Ping the service.
	* @return boolean success
	*/
	public function ping() {
		if (!$this->shouldPing()) {
			return false;
		}
		$curl = curl_init($this->buildURL());
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$curl_result = curl_exec($curl);
		$curl_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return ($curl_status == 200)? true : false;
	}

	/**
	* Build the url for calling pingomatic
	* @return string the url
	*/
	protected function buildURL() {
		return $this->pingomatic_url . '?' . http_build_query($this->properties);
	}

	/**
	* Determines if a ping should happen. Will not ping if the blogurl, title, and
	* rssurl are not set
	* @return boolean should ping?
	*/
	protected function shouldPing() {
		if (
			strlen($this->properties['title']) == 0 ||
			strlen($this->properties['rssurl']) == 0 ||
			strlen($this->properties['blogurl']) == 0
		) {
			return false;
		}
		return true;
	}
}
?>
