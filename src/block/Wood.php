<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace PocketMine\Block;

use PocketMine;
use PocketMine\Item\Item as Item;

class Wood extends Solid{
	const OAK = 0;
	const SPRUCE = 1;
	const BIRCH = 2;
	const JUNGLE = 3;

	public function __construct($meta = 0){
		parent::__construct(WOOD, $meta, "Wood");
		$names = array(
			WoodBlock::OAK => "Oak Wood",
			WoodBlock::SPRUCE => "Spruce Wood",
			WoodBlock::BIRCH => "Birch Wood",
			WoodBlock::JUNGLE => "Jungle Wood",
		);
		$this->name = $names[$this->meta & 0x03];
		$this->hardness = 10;
	}

	public function place(Item $item, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz){
		$faces = array(
			0 => 0,
			1 => 0,
			2 => 0b1000,
			3 => 0b1000,
			4 => 0b0100,
			5 => 0b0100,
		);

		$this->meta = ($this->meta & 0x03) | $faces[$face];
		$this->level->setBlock($block, $this, true, false, true);

		return true;
	}

	public function getDrops(Item $item, Player $player){
		return array(
			array($this->id, $this->meta & 0x03, 1),
		);
	}
}