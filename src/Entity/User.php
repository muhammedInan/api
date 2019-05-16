<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Groups;

/**
 *
  * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "user_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *      absolute = true
 *      )
 * )
 *
 *  @Hateoas\Relation(
 *      "new",
 *      href = @Hateoas\Route(
 *          "user_create",
 *      absolute = true
 *
 *     )
 * )
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     * @Groups({"details"}) 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"details"}) 
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"details"}) 
     */
    private $lastName;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }
    public function setClient(Client $client): self
    {
        $this->client = $client;
        // set the owning side of the relation if necessary
       
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}
