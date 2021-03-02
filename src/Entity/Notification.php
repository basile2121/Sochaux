<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEnvoie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $messageNotification;

    /**
     * @ORM\OneToOne(targetEntity=RapportSpecifique::class, cascade={"persist", "remove"})
     */
    private $rapportSpecifique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnvoie(): ?\DateTimeInterface
    {
        return $this->dateEnvoie;
    }

    public function setDateEnvoie(\DateTimeInterface $dateEnvoie): self
    {
        $this->dateEnvoie = $dateEnvoie;

        return $this;
    }

    public function getMessageNotification(): ?string
    {
        return $this->messageNotification;
    }

    public function setMessageNotification(?string $messageNotification): self
    {
        $this->messageNotification = $messageNotification;

        return $this;
    }

    public function getRapportSpecifique(): ?RapportSpecifique
    {
        return $this->rapportSpecifique;
    }

    public function setRapportSpecifique(?RapportSpecifique $rapportSpecifique): self
    {
        $this->rapportSpecifique = $rapportSpecifique;

        return $this;
    }
}
