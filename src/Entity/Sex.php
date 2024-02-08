<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('sex')]
#[ORM\Entity]
class Sex
{
    public const MAN = 1;
    public const WOMAN = 2;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $sex;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'sex')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    /** @return ArrayCollection<int, User> */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }
}
