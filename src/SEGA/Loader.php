<?php

namespace SEGA;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

use SEGA\leaderboards\LeaderboardManager;
use SEGA\provider\Database;
use SEGA\SEGAAPI;
use SEGA\SEGAListener;

class Loader extends PluginBase {

	private $config;

    public static $api;

    public static $database;

	private static $instance;

	public function onEnable() : void {
		self::$instance = $this;
        self::$api = new SEGAAPI();
        self::$database = new Database($this); 
		$this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, []);
        $this->leaderboardManager = new LeaderboardManager($this);
        $this->getServer()->getPluginManager()->registerEvents(new SEGAListener($this), $this);
	}

	public static function getInstance() {
        return self::$instance;
    }

     public static function getAPI(){
        return self::$api;
    }

    public static function getDatabase(){
        return self::$database;
    }

    public function getConfiguration() {
        return $this->config;
    }

    public function getLeaderboardManager(): LeaderboardManager {
        return $this->leaderboardManager;
    }


}