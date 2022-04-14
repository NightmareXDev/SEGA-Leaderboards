<?php

namespace SEGA;

use SEGA\Loader;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class SEGAAPI {

	public function getKills($player) : ?int { 
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $rq = Loader::$database->db->query("SELECT kills FROM players WHERE name = '" . strtolower($player->getName())."'");
                return $rq->fetchArray()[0]; 
        } else {
        	$rq = Loader::$database->db->query("SELECT kills FROM players WHERE name = '" . strtolower($player)."'");
                return $rq->fetchArray()[0];
        }
      }
    }

	public function addKill($player) : void {
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $newAmount = 1 + $this->getKills($player);
                    Loader::$database->db->exec("UPDATE players SET kills = $newAmount WHERE name='".strtolower($player->getName())."'");          
            } 
        }
    }

    public function getDeaths($player) : ?int { 
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $rq = Loader::$database->db->query("SELECT deaths FROM players WHERE name = '" . strtolower($player->getName())."'");
                return $rq->fetchArray()[0]; 
        } else {
        	$rq = Loader::$database->db->query("SELECT deaths FROM players WHERE name = '" . strtolower($player)."'");
                return $rq->fetchArray()[0];
        }
      }
    }

	public function addDeath($player) : void {
        if(Loader::$database->exists($player)){
            if($player instanceof Player){
                $newAmount = 1 + $this->getDeaths($player);
                    Loader::$database->db->exec("UPDATE players SET deaths = $newAmount WHERE name='".strtolower($player->getName())."'");          
            } 
        }
    }

    // CREDITS: FACTIONSPRO

    public function getTopKills() : string {
        $result = Loader::$database->db->query("SELECT name FROM players ORDER BY kills DESC LIMIT 10;");
        $i = 1;
        while ($resultArr = $result->fetchArray(SQLITE3_ASSOC)) {
            $j = $i + 1;
            $n = $resultArr['name'];
            $m = number_format($this->getKills($n));
            return TF::GRAY.$i."# ".TF::WHITE.$n." - ".TF::DARK_RED.$m;
            $i = $i + 1;
        }
    }

    public function getTopDeaths() : string {
        $result = Loader::$database->db->query("SELECT name FROM players ORDER BY deaths DESC LIMIT 10;");
        $i = 1;
        while ($resultArr = $result->fetchArray(SQLITE3_ASSOC)) {
            $j = $i + 1;
            $n = $resultArr['name'];
            $m = number_format($this->getDeaths($n));
            return TF::GRAY.$i."# ".TF::WHITE.$n." - ".TF::GOLD.$m;
            $i = $i + 1;
        }
    }
	
}