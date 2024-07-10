<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @method string getUserIdentifier()
 */
class User implements PasswordAuthenticatedUserInterface, UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $password;

    /**
     * @ORM\Column(type="string")
     */
    private string $street;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private string $zipcode;

    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
        ]);
    }

    public function unserialize($serialized): void
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getSalt(): string
    {
        return 'unPetitGrainDeSel';
    }

    public function __call(string $name, array $arguments)
    {
    }
}