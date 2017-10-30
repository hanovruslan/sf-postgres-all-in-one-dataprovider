<?php

namespace Evolaze\Paiod\AppBundle\Entity\Odm;

class MessageBody
{
    public $title;

    public $text;

    public $createdAt;

    public function __toString() {
        return $this->title . ': ' . $this->text . ' (created at '  . date('Y-m-d H:i:s', $this->createdAt) .  ')';
    }
}