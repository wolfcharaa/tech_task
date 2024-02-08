<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'users')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', unique: true)]
    #[Assert\NotNull, Assert\Email]
    private string $email;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull, Assert\Type('string')]
    private string $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull, Assert\Type('numeric')]
    private int $age;

    #[ORM\ManyToOne(targetEntity: Sex::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'sex_id', referencedColumnName: 'id')]
    #[Assert\NotNull, Assert\EqualTo(value: Sex::MAN || Sex::WOMAN)]
    private Sex $sex;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotNull, Assert\Type('datetime')]
    private DateTimeInterface $birthday;

    #[ORM\Column(type: 'bigint', unique: true)]
    #[Assert\NotNull, Assert\Type('numeric')]
    private int $phone;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    #[ORM\PrePersist]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSex(): Sex
    {
        return $this->sex;
    }

    public function getBirthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function setSex(Sex $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function setBirthday(DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'age' => $this->age,
            'sex' => $this->sex->getSex(),
            'birthday' => $this->birthday->format('Y-m-d'),
            'phone' => $this->phone,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'updatedAt' => $this->updatedAt->format('Y-m-d'),
        ];
    }
}
