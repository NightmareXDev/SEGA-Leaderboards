<?php

namespace SEGA;

use SEGA\Loader;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\event\entity\{EntityDamageEvent,
EntityDamageByEntityEvent};

class SEGAListener implements Listener {
	
	private $loader;
	
	public function __construct(Loader $loader) {
		$this->loader = $loader;
	}

	public function onPreLogin(PlayerPreLoginEvent $event) : void {
        
        $player = $event->getPlayerInfo()->getUsername();

        if(!$this->loader->getDatabase()->exists($player)) {
            $this->loader->getDatabase()->create($player);
        } 
    }

    public function onDeath(PlayerDeathEvent $event){

        $cause = $event->getEntity()->getLastDamageCause();

        if($cause instanceof EntityDamageByEntityEvent) {
            $killer = $cause->getDamager();
            $player = $event->getPlayer();
            if($killer instanceof Player){
                $this->loader->getAPI()->addDeath($player);
                $this->loader->getAPI()->addKill($killer);
            }  
        }

        if(is_null($cause)){
            return false;
        }
                        
    }

}