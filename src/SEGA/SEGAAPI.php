<?php

namespace SEGA;

use SEGA\Loader;
use pocketmine\player\Player;

class SEGAAPI {

	public function getKills($player) : ?int { 
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $rq = Loader::$database->db->query("SELECT kills FROM players WHERE name = '" . strtolower($player->getName())."'");
                return $rq->fetchArray()[0]; 
        }
      }
    }

	public function addKill($player) : void {
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $newAmount = 1 + $player->getKills();
                    Loader::$database->db->exec("UPDATE players SET kills = $newAmount WHERE name='".strtolower($player->getName())."'");          
            } 
        }
    }

    public function getDeaths($player) : ?int { 
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $rq = Loader::$database->db->query("SELECT deaths FROM players WHERE name = '" . strtolower($player->getName())."'");
                return $rq->fetchArray()[0]; 
        }
      }
    }

	public function addDeath($player) : void {
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $newAmount = 1 + $player->getDeaths();
                    Loader::$database->db->exec("UPDATE players SET deaths = $newAmount WHERE name='".strtolower($player->getName())."'");          
            } 
        }
    }
	
}