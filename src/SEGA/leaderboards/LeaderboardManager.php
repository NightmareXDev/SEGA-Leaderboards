<?php

namespace SEGA\leaderboards;

use SEGA\Loader;
use SEGA\leaderboards\types\KillsLeaderboard;
use SEGA\leaderboards\types\DeathsLeaderboard;

class LeaderboardManager {
	
	private $loader;
	
	public function __construct(Loader $loader) {
		$this->loader = $loader;

		$this->loader->getScheduler()->scheduleRepeatingTask(new KillsLeaderboard($this->loader), 3 * 20);
		$this->loader->getScheduler()->scheduleRepeatingTask(new DeathsLeaderboard($this->loader), 3 * 20);
	}

}