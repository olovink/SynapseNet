<?php

declare(strict_types=1);

namespace synapsenet\network\protocol\packets\handshake;

use synapsenet\binary\Binary;
use synapsenet\network\protocol\packets\Packet;
use synapsenet\network\protocol\packets\PacketIdentifiers;
use synapsenet\network\protocol\packets\PacketWrite;

class UnconnectedPong extends Packet implements PacketWrite {

    /** @var int */
    private int $packetId = PacketIdentifiers::UNCONNECTED_PONG;

    /** @var int */
    public int $time;

    /** @var int */
    public int $serverGuid;

    /** @var string */
    public string $serverIdString;

    public function __construct() {
        parent::__construct($this->packetId, "");
    }

    /**
     * @return string
     */
    public function make(): string {
        $this->buffer .= chr($this->getPacketId());
        $this->buffer .= Binary::writeLong($this->time);
        $this->buffer .= Binary::writeLong($this->serverGuid);
        $this->buffer .= $this->magic;
        $this->buffer .= Binary::writeShort(strlen($this->serverIdString));
        $this->buffer .= $this->serverIdString;

        return $this->buffer;
    }
}
