<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeUserRepository")
 */
class TypeUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@ORM\Column(type="string",length=100)
     **/
    private  $typeName;

    /**
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param mixed $typeName
     */
    public function setTypeName($typeName): void
    {
        $this->typeName = $typeName;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
}
