<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $numjugadores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultado", mappedBy="equipolocal")
     */
    private $resultadoslocales;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultado", mappedBy="equipovisitante")
     */
    private $resultadosvisitantes;

    public function __construct()
    {
        $this->resultados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getNumjugadores(): ?int
    {
        return $this->numjugadores;
    }

    public function setNumjugadores(int $numjugadores): self
    {
        $this->numjugadores = $numjugadores;

        return $this;
    }

    /**
     * @return Collection|Resultado[]
     */
    public function getResultados(): Collection
    {
        return $this->resultados;
    }

    public function addResultado(Resultado $resultado): self
    {
        if (!$this->resultados->contains($resultado)) {
            $this->resultados[] = $resultado;
            $resultado->setEquipolocal($this);
        }

        return $this;
    }

    public function removeResultado(Resultado $resultado): self
    {
        if ($this->resultados->contains($resultado)) {
            $this->resultados->removeElement($resultado);
            // set the owning side to null (unless already changed)
            if ($resultado->getEquipolocal() === $this) {
                $resultado->setEquipolocal(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->categoria;
    }
}
