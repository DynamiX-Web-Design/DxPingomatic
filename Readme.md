#DxPingomatic (Dynamix Web Design, LLC Pingomatic code)

* **Easily submit site to Pingomatic**
* Both web and command line friendly
* Complete control over which services that you use
* Easily integrates into any project

#Example Usage

**Ping all services**

    $dxp = $dxp = new DxPingomatic('Help Me Advertise Atlanta', 'http://www.helpmeadvertiseatlanta.com', 'http://www.helpmeadvertiseatlanta.com/feed.rss', true);
	$success = $dxp->ping();
