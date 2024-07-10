<?php
declare(strict_types=1);

namespace App\Entity;

use App\Helper\VATCalculator;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    private string $isnb;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @var Writer
     * @ORM\ManyToOne(targetEntity="App\Entity\Writer", inversedBy="books")
     */
    private Writer $author;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $publishDate;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private int $nbPage;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private string $summary;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private float $price;


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
    public function getIsnb(): string
    {
        return $this->isnb;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Individual
     */
    public function getAuthor(): Individual
    {
        return $this->author;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublishDate(): \DateTimeInterface
    {
        return $this->publishDate;
    }

    /**
     * @return int
     */
    public function getNbPage(): int
    {
        return $this->nbPage;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return VATCalculator::formatValue($this->price);
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return 'book';
    }
}
