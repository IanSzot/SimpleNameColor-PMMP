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
                case $player->hasPermission("snc.aqua"):
                    return TextFormat::AQUA;
                case $player->hasPermission("snc.black"):
                    return TextFormat::BLACK;
                case $player->hasPermission("snc.blue"):
                    return TextFormat::BLUE;
                case $player->hasPermission("snc.darkaqua"):
                    return TextFormat::DARK_AQUA;
                case $player->hasPermission("snc.darkblue"):
                    return TextFormat::DARK_BLUE;
                case $player->hasPermission("snc.darkgray"):
                    return TextFormat::DARK_GRAY;
                case $player->hasPermission("snc.darkgreen"):
                    return TextFormat::DARK_GREEN;
                case $player->hasPermission("snc.darkpurple"):
                    return TextFormat::DARK_PURPLE;
                case $player->hasPermission("snc.darkred"):
                    return TextFormat::DARK_RED;
                case $player->hasPermission("snc.gold"):
                    return TextFormat::GOLD;
                case $player->hasPermission("snc.gray"):
                    return TextFormat::GRAY;
                case $player->hasPermission("snc.green"):
                    return TextFormat::GREEN;
                case $player->hasPermission("snc.lightpurple"):
                    return TextFormat::LIGHT_PURPLE;
                case $player->hasPermission("snc.red"):
                    return TextFormat::RED;
                case $player->hasPermission("snc.yellow"):
                    return TextFormat::YELLOW;
                case $player->hasPermission("snc.white"):
                    return TextFormat::WHITE;
                default:
                    return TextFormat::WHITE;
            }
            
    }
        
    // checks for style permission
    public function checkStylePerm($player, $perm) : string{
            switch($player){
                case $perm === 'snc.italic' && $player->hasPermission($perm):
                    return TextFormat::ITALIC;
                case $perm === 'snc.bold' && $player->hasPermission($perm):
                    return TextFormat::BOLD;
                case  $perm === 'snc.strikethrough' && $player->hasPermission($perm):
                    return TextFormat::STRIKETHROUGH;
                case $perm === 'snc.underline' && $player->hasPermission($perm):
                    return TextFormat::UNDERLINE;
                case $perm === 'snc.obfuscated' && $player->hasPermission($perm):
                    return TextFormat::OBFUSCATED;
                default:
                    return TextFormat::RESET;
            }
            
    }

    // players can have more than one style. This take care of it by adding the styles in one array.
    public function checkStyles($player) : array{
            $styles = array('snc.italic', 'snc.bold', 'snc.strikethrough', 'snc.underline', 'snc.obfuscated');
            $playerstyle = array();
            foreach ($styles as $style) {
                if($player->hasPermission($style)){
                  $playerstyle[] = $this->checkStylePerm($player, $style);
                }
            }
            return $playerstyle;
    }
        
    // does the thing that it's supposed to do.
    public function onPlayerChat(PlayerChatEvent $event) : void{
            $color = $this->checkColorPerm($event->getPlayer());
            $styles = $this->checkStyles($event->getPlayer());
                
            // formats the message adding the color and style
            $event->setFormat("<" . implode($styles) . $color . $event->getPlayer()->getDisplayName() . TextFormat::RESET . "> " . $event->getMessage());

                                     
    }

        
}

