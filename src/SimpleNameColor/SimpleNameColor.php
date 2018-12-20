<?php

declare(strict_types=1);


namespace SimpleNameColor;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

class SimpleNameColor extends PluginBase implements Listener{
    
	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::DARK_GREEN . "SimpleNameColor enabled");
                
	}
        
    public function onDisable() : void{
        $this->getLogger()->info(TextFormat::DARK_RED . "SimpleNameColor disabled");
                
    }
    
            
    // checks for color permissions
    public function checkColorPerm($player) : string{
            switch($player){
                case $player->hasPermission("snp.aqua"):
                    return TextFormat::AQUA;
                case $player->hasPermission("snp.black"):
                    return TextFormat::BLACK;
                case $player->hasPermission("snp.blue"):
                    return TextFormat::BLUE;
                case $player->hasPermission("snp.darkaqua"):
                    return TextFormat::DARK_AQUA;
                case $player->hasPermission("snp.darkblue"):
                    return TextFormat::DARK_BLUE;
                case $player->hasPermission("snp.darkgray"):
                    return TextFormat::DARK_GRAY;
                case $player->hasPermission("snp.darkgreen"):
                    return TextFormat::DARK_GREEN;
                case $player->hasPermission("snp.darkpurple"):
                    return TextFormat::DARK_PURPLE;
                case $player->hasPermission("snp.darkred"):
                    return TextFormat::DARK_RED;
                case $player->hasPermission("snp.gold"):
                    return TextFormat::GOLD;
                case $player->hasPermission("snp.gray"):
                    return TextFormat::GRAY;
                case $player->hasPermission("snp.green"):
                    return TextFormat::GREEN;
                case $player->hasPermission("snp.lightpurple"):
                    return TextFormat::LIGHT_PURPLE;
                case $player->hasPermission("snp.red"):
                    return TextFormat::RED;
                case $player->hasPermission("snp.yellow"):
                    return TextFormat::YELLOW;
                case $player->hasPermission("snp.white"):
                    return TextFormat::WHITE;
                default:
                    return TextFormat::WHITE;
            }
            
    }
        
    // checks for style permission
    public function checkStylePerm($player) : string{
            switch($player){
                case $player->hasPermission("snp.italic"):
                    return TextFormat::ITALIC;
                case $player->hasPermission("snp.bold"):
                    return TextFormat::BOLD;
                case $player->hasPermission("snp.strikethrough"):
                    return TextFormat::STRIKETHROUGH;
                case $player->hasPermission("snp.underline"):
                    return TextFormat::UNDERLINE;
                case $player->hasPermission("snp.obfuscated"):
                    return TextFormat::OBFUSCATED;
                default:
                    return TextFormat::RESET;
            }
            
    }
        
    // does the thing that it's supposed to do.
    public function onPlayerChat(PlayerChatEvent $event) : void{
                $color = $this->checkColorPerm($event->getPlayer());
                $style = $this->checkStylePerm($event->getPlayer());
                
                // formats the message adding the color and style
                $event->setFormat("<" . $style . $color . $event->getPlayer()->getDisplayName() . TextFormat::RESET . "> " . $event->getMessage());

                                     
    }

    

        
}

