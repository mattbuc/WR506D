<?php

namespace App\EventSubscriber;

use App\Entity\Movie;
use App\EventListener\EntitySavedEvent;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntitySavedEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // Vérifier si l'entité est de type YourEntity (à adapter selon votre entité)
        if (!$entity instanceof YourEntity) {
            $event = new EntitySavedEvent($entity);
            // Déclencher l'événement
            $args->getObjectManager()->getEventManager()->dispatchEvent($event);
        }


    }
}