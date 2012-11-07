#DxPingomatic (Dynamix Web Design, LLC Pingomatic code)

* **Easily submit site to Pingomatic**
* Both web and command line friendly
* Complete control over which services that you use
* Easily integrates into any project

#License

Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)
http://creativecommons.org/licenses/by-sa/3.0/deed.en_US

#Example Usage

**Ping all services**

    $dxp = $dxp = new DxPingomatic('Help Me Advertise Atlanta', 'http://www.helpmeadvertiseatlanta.com', 'http://www.helpmeadvertiseatlanta.com/feed.rss', true);
	$success = $dxp->ping();
