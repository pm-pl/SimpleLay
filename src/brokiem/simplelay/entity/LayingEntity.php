<?php

declare(strict_types=1);

/*
 *  ____    _                       _          _
 * / ___|  (_)  _ __ ___    _ __   | |   ___  | |       __ _   _   _
 * \___ \  | | | '_ ` _ \  | '_ \  | |  / _ \ | |      / _` | | | | |
 *  ___) | | | | | | | | | | |_) | | | |  __/ | |___  | (_| | | |_| |
 * |____/  |_| |_| |_| |_| | .__/  |_|  \___| |_____|  \__,_|  \__, |
 *                         |_|                                 |___/
 *
 * Copyright (C) 2020 - 2021 brokiem
 *
 * This software is distributed under "GNU General Public License v3.0".
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see
 * <https://opensource.org/licenses/GPL-3.0>.
 *
 */

namespace brokiem\simplelay\entity;

use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;

class LayingEntity extends Human {
    private Player $player;

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null, ?Player $player = null) {
        parent::__construct($location, $skin, $nbt);

        if ($player !== null) {
            $this->player = $player;
        }
    }

    public function onUpdate(int $currentTick): bool {
        if ($this->isFlaggedForDespawn()) {
            return false;
        }

        $this->getArmorInventory()->setContents($this->player->getArmorInventory()->getContents());
        $this->getInventory()->setHeldItemIndex($this->player->getInventory()->getHeldItemIndex());
        return true;
    }

    public function attack(EntityDamageEvent $source): void {

    }
}
