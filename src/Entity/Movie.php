<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"dvd" = "Dvd", "br" = "BluRay"})
 */
abstract class Movie
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
    private string $asin;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @var Director
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="movies")
     */
    private Director $director;

    /**
     * @var Collection|Actor[]
     * @ORM\ManyToMany(targetEntity="Actor", cascade={"persist"}, fetch="EAGER")
     */
    private $cast;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $releaseDate;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private int $duration;

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
     * Movie constructor.
     * @param $id
     * @param string $asin
     * @param string $title
     * @param \DateTimeInterface $releaseDate
     * @param int $duration
     * @param string $summary
     * @param float $price
     * @param array $cast
     */
    public function __construct($id, string $asin, string $title, \DateTimeInterface $releaseDate, int $duration, string $summary, float $price, array $cast)
    {
        $this->id = $id;
        $this->asin = $asin;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->duration = $duration;
        $this->summary = $summary;
        $this->price = $price;
        $this->cast = new ArrayCollection($cast);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAsin(): string
    {
        return $this->asin;
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
    public function getDirector(): Individual
    {
        return $this->director;
    }

    /**
     * @return Actor[]|Collection
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): \DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
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
        return $this->price;
    }

    /**
     * @return string
     */
    abstract public function getMedia(): string;
}
