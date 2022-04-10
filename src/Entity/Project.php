<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $project_logo;

    #[ORM\Column(type: 'string', length: 255)]
    private $project_image;

    #[ORM\ManyToMany(targetEntity: Tech::class, inversedBy: 'projects')]
    private $tech;

    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'projects')]
    private $collaborators;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ownerProjects')]
    private $user;

    public function __construct()
    {
        $this->tech = new ArrayCollection();
        $this->collaborators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProjectLogo(): ?string
    {
        return $this->project_logo;
    }

    public function setProjectLogo(?string $project_logo): self
    {
        $this->project_logo = $project_logo;

        return $this;
    }

    public function getProjectImage(): ?string
    {
        return $this->project_image;
    }

    public function setProjectImage(string $project_image): self
    {
        $this->project_image = $project_image;

        return $this;
    }

    /**
     * @return Collection|Tech[]
     */
    public function getTech(): Collection
    {
        return $this->tech;
    }

    public function addTech(Tech $tech): self
    {
        if (!$this->tech->contains($tech)) {
            $this->tech[] = $tech;
        }

        return $this;
    }

    public function removeTech(Tech $tech): self
    {
        $this->tech->removeElement($tech);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCollaborators(): Collection
    {
        return $this->collaborators;
    }

    public function addCollaborator(User $collaborator): self
    {
        if (!$this->collaborators->contains($collaborator)) {
            $this->collaborators[] = $collaborator;
        }

        return $this;
    }

    public function removeCollaborator(User $collaborator): self
    {
        $this->collaborators->removeElement($collaborator);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
