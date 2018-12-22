<?php

declare(strict_types=1);


namespace IanSzot\SimpleNameColor;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;

class SimpleNameColor extends PluginBase implements Listener{
    
	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
                
	}
          
            
    // checks for color permissions
    public function checkColorPerm($player) : string{
            switch($player){
                case $player->hasPermission("simplenamecolor.aqua"):
                    return TextFormat::AQUA;
                case $player->hasPermission("simplenamecolor.black"):
                    return TextFormat::BLACK;
                case $player->hasPermission("simplenamecolor.blue"):
                    return TextFormat::BLUE;
                case $player->hasPermission("simplenamecolor.darkaqua"):
                    return TextFormat::DARK_AQUA;
                case $player->hasPermission("simplenamecolor.darkblue"):
                    return TextFormat::DARK_BLUE;
                case $player->hasPermission("simplenamecolor.darkgray"):
                    return TextFormat::DARK_GRAY;
                case $player->hasPermission("simplenamecolor.darkgreen"):
                    return TextFormat::DARK_GREEN;
                case $player->hasPermission("simplenamecolor.darkpurple"):
                    return TextFormat::DARK_PURPLE;
                case $player->hasPermission("simplenamecolor.darkred"):
                    return TextFormat::DARK_RED;
                case $player->hasPermission("simplenamecolor.gold"):
                    return TextFormat::GOLD;
                case $player->hasPermission("simplenamecolor.gray"):
                    return TextFormat::GRAY;
                case $player->hasPermission("simplenamecolor.green"):
                    return TextFormat::GREEN;
                case $player->hasPermission("simplenamecolor.lightpurple"):
                    return TextFormat::LIGHT_PURPLE;
                case $player->hasPermission("simplenamecolor.red"):
                    return TextFormat::RED;
                case $player->hasPermission("simplenamecolor.yellow"):
                    return TextFormat::YELLOW;
                case $player->hasPermission("simplenamecolor.white"):
                    return TextFormat::WHITE;
                default:
                    return TextFormat::WHITE;
            }
            
    }
        
    // checks for style permission
    public function checkStylePerm($player, $perm) : string{
            switch($player){
                case $perm === 'simplenamecolor.italic' && $player->hasPermission($perm):
                    return TextFormat::ITALIC;
                case $perm === 'simplenamecolor.bold' && $player->hasPermission($perm):
                    return TextFormat::BOLD;
                case  $perm === 'simplenamecolor.strikethrough' && $player->hasPermission($perm):
                    return TextFormat::STRIKETHROUGH;
                case $perm === 'simplenamecolor.underline' && $player->hasPermission($perm):
                    return TextFormat::UNDERLINE;
                case $perm === 'simplenamecolor.obfuscated' && $player->hasPermission($perm):
                    return TextFormat::OBFUSCATED;
                default:
                    return TextFormat::RESET;
            }
            
    }

    // players can have more than one style. This take care of it by adding the styles in one array.
    public function checkStyles($player) : array{
            $styles = array('simplenamecolor.italic', 'simplenamecolor.bold', 'simplenamecolor.strikethrough', 'simplenamecolor.underline', 'simplenamecolor.obfuscated');
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

