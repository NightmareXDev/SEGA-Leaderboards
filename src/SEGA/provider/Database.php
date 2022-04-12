<?php

namespace SEGA\provider;

use SEGA\Loader;
use pocketmine\player\Player;

class Database {
	
	private $loader;
	
	public $db;
	
	public function __construct(Loader $loader) {
		
		$this->loader = $loader;
		
		$this->db = new \SQLite3($this->loader->getDataFolder()."data.db");
		$this->db->exec("CREATE TABLE IF NOT EXISTS players (name VARCHAR(25), kills INT, deaths INT)");
	}
		
    public function exists($player): bool {
    	if($player instanceof Player){
	     	return count($this->getData($player->getName())) != 0; 
        }else{
         	return count($this->getData($player)) != 0; 
        }
	} 

	public function create($player) : void { 
		if($player instanceof Player){
	 		$player = strtolower($player->getName());
	  		$this->db->exec("INSERT INTO players (name, kills, deaths) VALUES ('$player', 0, 0)"); 
	    }else{
	    	$player = strtolower($player);
	  		$this->db->exec("INSERT INTO players (name, kills, deaths) VALUES ('$player', 0, 0)"); 
	    }
	}

	public function getData($player) : array {
	   	$rq = $this->db->query("SELECT * FROM players WHERE name = '".strtolower($player)."'");
	   	$rslt = $rq->fetchArray(); return ($rslt === false ? [] : $rslt);  
	}
	   	  
}