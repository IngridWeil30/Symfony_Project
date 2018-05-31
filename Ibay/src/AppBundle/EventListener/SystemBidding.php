<?php
/**
 * Created by PhpStorm.
 * User: ingridweil
 * Date: 5/29/18
 * Time: 4:14 PM
 */

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Bidding;

class SystemBidding
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $bidding = $args->getEntity();

        if (!$bidding instanceof Bidding) {
            return;
        }

        //$entityManager = $args->getEntityManager();

        $product = $bidding->getProducts();
        $bid = $bidding->getBid();
        $immediate_price = $product->getImmediatePrice();
        $minimum_bid = $product->getMinimumBid();

        if ($bid > $immediate_price) {
            $product->setIsSold(true);
        }
        else
        {
            if ($bid > $minimum_bid) {
                $product->setMinimumBid($bid);
            }
            else
            {
                echo('Please fill the field with a higher value than the minimum bid');
            }
        }
    }
}