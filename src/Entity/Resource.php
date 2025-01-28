<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToOne(inversedBy: 'resources')]
    #[ORM\JoinColumn(name: 'subject', referencedColumnName: 'id')]
    private ?Topic $topic = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finishDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $progress = null;

    /**
     * @var Collection<int, ProgressLog>
     */
    #[ORM\OneToMany(targetEntity: ProgressLog::class, mappedBy: 'resource')]
    private Collection $progressLogs;

    public function __construct()
    {
        $this->progressLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic): static
    {
        $this->topic = $topic;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finishDate;
    }

    public function setFinishDate(?\DateTimeInterface $finishDate): static
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(?int $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * @return Collection<int, ProgressLog>
     */
    public function getProgressLogs(): Collection
    {
        return $this->progressLogs;
    }

    public function addProgressLog(ProgressLog $progressLog): static
    {
        if (!$this->progressLogs->contains($progressLog)) {
            $this->progressLogs->add($progressLog);
            $progressLog->setResource($this);
        }

        return $this;
    }

    public function removeProgressLog(ProgressLog $progressLog): static
    {
        if ($this->progressLogs->removeElement($progressLog)) {
            // set the owning side to null (unless already changed)
            if ($progressLog->getResource() === $this) {
                $progressLog->setResource(null);
            }
        }

        return $this;
    }
}
