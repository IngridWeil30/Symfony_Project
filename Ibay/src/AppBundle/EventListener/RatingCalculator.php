<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Product_Rating;

class RatingCalculator
{
   public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

// only act on some "Product_Rating" entity
        if (!$entity instanceof Product_Rating) {
            return;
        }

        $entityManager = $args->getEntityManager();

        $product = $entity->getProduct();
        $count_rating = $product->getNbRates();
        $avg_rating = $product->getRatingFinal();
        $total_rating = $avg_rating * $count_rating + $entity->getRating();
        $new_count_rating = $count_rating + 1;
        $product->setNbRates($count_rating + 1);
        $product->setRating_final($total_rating / $new_count_rating);
    }
}

