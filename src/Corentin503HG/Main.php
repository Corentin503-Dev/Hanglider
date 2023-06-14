<?php

namespace Corentin503HG;

use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase
{
    use SingletonTrait;

    protected function onEnable(): void
    {
        self::setInstance($this);

        $this->saveDefaultConfig();

        $this->getServer()->getPluginManager()->registerEvents(new PlayerEvents(), $this);
    }

    public function checkHeld(Player $player, Item $item)
    {
        if ($item->getId() == $this->getConfig()->get("id") && $item->getId() == $this->getConfig()->get("meta")) {
            $player->getEffects()->add(new CustomEffectInstance(VanillaEffects::LEVITATION(), 10000 * 100000, $this->getConfig()->get("force"), false));
        } else $player->getEffects()->remove(VanillaEffects::LEVITATION());
    }
}