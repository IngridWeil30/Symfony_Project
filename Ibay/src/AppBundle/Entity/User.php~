<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="new_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="The first name is too short.",
     *     maxMessage="The first name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="The last name is too short.",
     *     maxMessage="The last name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your postal address.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The postal address is too short.",
     *     maxMessage="The postal address is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $postal_address;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product_Rating", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */

    protected $products_rating;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bidding", mappedBy="userBidder", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */

    protected $products;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add productsRating
     *
     * @param \AppBundle\Entity\Product_Rating $productsRating
     *
     * @return User
     */
    public function addProductsRating(\AppBundle\Entity\Product_Rating $productsRating)
    {
        $productsRating->setUser($this);
        $this->products_rating[] = $productsRating;

        return $this;
    }

    /**
     * Remove productsRating
     *
     * @param \AppBundle\Entity\Product_Rating $productsRating
     */
    public function removeProductsRating(\AppBundle\Entity\Product_Rating $productsRating)
    {
        $productsRating->setUser(null);
        $this->products_rating->removeElement($productsRating);
    }

    /**
     * Get productsRating
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductsRating()
    {
        return $this->products_rating;
    }

    /**
     * Get productsRatings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductsRatings()
    {
        return $this->products_rating;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return User
     */
    public function setPostalAddress($postalAddress)
    {
        $this->postal_address = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->postal_address;
    }

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return User
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $product->setUserOwner($this);
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $product->setUserOwner(null);
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
