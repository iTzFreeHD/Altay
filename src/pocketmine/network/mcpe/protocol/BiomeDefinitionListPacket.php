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

namespace pocketmine\network\mcpe\protocol;

#include <rules/DataPacket.h>

use pocketmine\network\mcpe\handler\SessionHandler;

class BiomeDefinitionListPacket extends DataPacket implements ClientboundPacket{
	public const NETWORK_ID = ProtocolInfo::BIOME_DEFINITION_LIST_PACKET;

	/** @var string */
	public $namedtag;

	protected function decodePayload() : void{
		$this->namedtag = $this->getRemaining();
	}

	protected function encodePayload() : void{
		$this->put($this->namedtag);
	}

	public function handle(SessionHandler $handler) : bool{
		return $handler->handleBiomeDefinitionList($this);
	}
}