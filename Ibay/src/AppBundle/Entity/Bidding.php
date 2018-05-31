<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bidding
 *
 * @ORM\Table(name="bidding")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BiddingRepository")
 */
class Bidding
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="bid", type="float", nullable=true)
     */
    private $bid;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="bidding", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */

    protected $products;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="bidding", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */

    protected $userBidder;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userBidder
     *
     * @param string $userBidder
     *
     * @return Bidding
     */
    public function setUserBidder($userBidder)
    {
        $this->userBidder = $userBidder;

        return $this;
    }

    /**
     * Get userBidder
     *
     * @return string
     */
    public function getUserBidder()
    {
        return $this->userBidder;
    }

    /**
     * Set products
     *
     * @param \AppBundle\Entity\Product $products
     *
     * @return Bidding
     */
    public function setProducts(\AppBundle\Entity\Product $products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set bid
     *
     * @param float $bid
     *
     * @return Bidding
     */
    public function setBid($bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return float
     */
    public function getBid()
    {
        return $this->bid;
    }
}
