<?php
/**
 * Created by PhpStorm.
 * User: ingridweil
 * Date: 5/25/18
 * Time: 5:29 PM
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserProduct
{
    private $security;

    public function __construct(TokenStorageInterface $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if (!$entity instanceof Product) {
            return;
        }

        $entity->setUserOwner($this->security->getToken()->getUser());
    }
}