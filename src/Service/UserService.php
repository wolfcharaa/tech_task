<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Sex;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    public function __construct(
        private ValidatorInterface $validator,
        private EntityManagerInterface $em
    ) {
    }

    public function updateOrCreate(array $data, User $user = null): User
    {
        $user ??= (new User());

        $user->setName($data['name'])
            ->setAge((int) $data['age'])
            ->setSex($this->em->getReference(Sex::class, (int)$data['sex']))
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setBirthday(new DateTime($data['birthday']));

        $errors = $this->validator->validate($user);

        if ($count = $errors->count()) {
            $message = '';

            for ($i = 0; $i < $count; $i++) {
                $error = $errors->get($i);

                $message .= "'{$error->getPropertyPath()}' {$error->getMessage()} \n";
            }

            throw new BadRequestHttpException($message);
        }

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function removeUser(User $user): void
    {
        $this->em->remove($user);
    }
}
