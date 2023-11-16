<?php

namespace App\EventListener;

use App\Entity\Movie;
use Symfony\Contracts\EventDispatcher\Event;

class EntitySavedEvent extends Event
{
    private $entity;

    public function __construct(YourEntity $entity)
    {
        $this->entity = $entity;
    }

    public function getEntity(): Movie
    {
        return $this->entity;
    }
}
