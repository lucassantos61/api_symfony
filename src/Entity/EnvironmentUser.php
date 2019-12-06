<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnvironmentUserRepository")
 */
class EnvironmentUser
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
    private  $enviromenmetName;

    /**
     * @return mixed
     */
    public function getEnviromenmetName()
    {
        return $this->enviromenmetName;
    }

    /**
     * @param mixed $enviromenmetName
     */
    public function setEnviromenmetName($enviromenmetName): void
    {
        $this->enviromenmetName = $enviromenmetName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
