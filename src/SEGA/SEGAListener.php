<?php

namespace SEGA;

use SEGA\Loader;
use pocketmine\event\Listener;

class SEGAListener implements Listener {
	
	private $loader;
	
	public function __construct(Loader $loader) {
		$this->loader = $loader;
	}

}