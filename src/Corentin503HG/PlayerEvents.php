<?php

namespace Corentin503HG;

use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;

class PlayerEvents implements Listener
{
    public function onJoin(PlayerJoinEvent $event)
    {
        $event->getPlayer()->getEffects()->remove(VanillaEffects::LEVITATION());
    }

    public function onHeld(PlayerItemHeldEvent $event)
    {
        Main::getInstance()->checkHeld($event->getPlayer(), $event->getItem());
    }

    public function onDamage(EntityDamageEvent $event)
    {
        $player = $event->getEntity();

        if ($player instanceof Player) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
                if ($player->getEffects()->has(VanillaEffects::LEVITATION())) $player->getEffects()->remove(VanillaEffects::LEVITATION());
            }
        }
    }
}