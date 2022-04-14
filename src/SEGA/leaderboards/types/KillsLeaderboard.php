<?php

namespace SEGA\leaderboards\types;

use SEGA\Loader;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\world\Position;;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

use WolfDen133\WFT\WFT;
use WolfDen133\WFT\Texts\FloatingText;

class KillsLeaderboard extends Task {

	private $loader;
	
	public function __construct(Loader $loader) {
		$this->loader = $loader;
	}

	 public function onRun(): void {

	 	$currentTick = Server::getInstance()->getTick();

		$floatingText = new FloatingText(new Position($this->loader->getConfiguration()->get("Kills")["x"], $this->loader->getConfiguration()->get("Kills")["y"], $this->loader->getConfiguration()->get("Kills")["z"], $this->loader->getServer()->getWorldManager()->getWorldByName($this->loader->getConfiguration()->get("Kills")["world"])), " ", "TOP KILLS LEADERBOARD\n\n".$this->loader->getAPI()->getTopKills());
		WFT::getAPI()->registerText($floatingText);
		WFT::getAPI()::respawnToAll($floatingText);

	}

}