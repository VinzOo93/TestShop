<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="purchase_oder")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $deliveryStreet;
    /**
     * @ORM\Column(type="string")
     */
    private string $deliveryZipcode;
    /**
     * @ORM\Column(type="string")
     */
    private string $deliveryCity;

    /**
     * @ORM\Column(type="string")
     */
    private string $cart;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * Order constructor.
     * @param string $deliveryStreet
     * @param string $deliveryZipcode
     * @param string $deliveryCity
     * @param array $cart
     */
    public function __construct(string $deliveryStreet, string $deliveryZipcode, string $deliveryCity, array $cart, float $price)
    {
        $this->deliveryStreet = $deliveryStreet;
        $this->deliveryZipcode = $deliveryZipcode;
        $this->deliveryCity = $deliveryCity;
        $this->cart = \json_encode($cart);
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDeliveryStreet(): string
    {
        return $this->deliveryStreet;
    }

    /**
     * @return string
     */
    public function getDeliveryZipcode(): string
    {
        return $this->deliveryZipcode;
    }

    /**
     * @return string
     */
    public function getDeliveryCity(): string
    {
        return $this->deliveryCity;
    }

    /**
     * @return array
     */
    public function getCart(): array
    {
        return \json_decode($this->cart, true);
    }

    /**
     * @return mixed
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
