<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\math\Facing;

class ConcretePowder extends Fallable{

	public function getHardness() : float{
		return 0.5;
	}

	public function getToolType() : int{
		return BlockToolType::TYPE_SHOVEL;
	}

	public function onNearbyBlockChange() : void{
		if(($block = $this->checkAdjacentWater()) !== null){
			$this->level->setBlock($this, $block);
		}else{
			parent::onNearbyBlockChange();
		}
	}

	/**
	 * @return null|Block
	 */
	public function tickFalling() : ?Block{
		return $this->checkAdjacentWater();
	}

	/**
	 * @return null|Block
	 */
	private function checkAdjacentWater() : ?Block{
		foreach(Facing::ALL as $i){
			if($i === Facing::DOWN){
				continue;
			}
			if($this->getSide($i) instanceof Water){
				return BlockFactory::get(Block::CONCRETE, $this->variant);
			}
		}

		return null;
	}
}
