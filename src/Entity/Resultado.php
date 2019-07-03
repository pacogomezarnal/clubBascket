<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultadoRepository")
 */
class Resultado
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntoslocal;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntosvisitante;

    /**
     * @ORM\Column(type="date")
     */
    private $fechapartido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cancha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo", inversedBy="resultadoslocales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipolocal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo", inversedBy="resultadosvisitantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipovisitante;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuntoslocal(): ?int
    {
        return $this->puntoslocal;
    }

    public function setPuntoslocal(int $puntoslocal): self
    {
        $this->puntoslocal = $puntoslocal;

        return $this;
    }

    public function getPuntosvisitante(): ?int
    {
        return $this->puntosvisitante;
    }

    public function setPuntosvisitante(int $puntosvisitante): self
    {
        $this->puntosvisitante = $puntosvisitante;

        return $this;
    }

    public function getFechapartido(): ?\DateTimeInterface
    {
        return $this->fechapartido;
    }

    public function setFechapartido(\DateTimeInterface $fechapartido): self
    {
        $this->fechapartido = $fechapartido;

        return $this;
    }

    public function getCancha(): ?string
    {
        return $this->cancha;
    }

    public function setCancha(?string $cancha): self
    {
        $this->cancha = $cancha;

        return $this;
    }

    public function getEquipolocal(): ?Equipo
    {
        return $this->equipolocal;
    }

    public function setEquipolocal(?Equipo $equipolocal): self
    {
        $this->equipolocal = $equipolocal;

        return $this;
    }

    public function getEquipovisitante(): ?Equipo
    {
        return $this->equipovisitante;
    }

    public function setEquipovisitante(?Equipo $equipovisitante): self
    {
        $this->equipovisitante = $equipovisitante;

        return $this;
    }
}
