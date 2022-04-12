<?php

namespace SEGA\leaderboards;

use SEGA\Loader;

class LeaderboardManager {
	
	private $loader;
	
	public function __construct(Loader $loader) {
		$this->loader = $loader;
	}

}