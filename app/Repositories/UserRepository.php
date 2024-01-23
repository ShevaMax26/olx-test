<?php

namespace App\Repositories;

use App\Entities\Announcement;
use App\Entities\User;
use App\Helpers\Collection;
use Doctrine\DBAL\Connection;

class UserRepository
{
    public function __construct(private Connection $connection)
    {
    }

    public function findByEmail(string $email): ?User
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $result = $queryBuilder->select('*')
            ->from('users')
            ->where('email = :email')
            ->setParameter('email', $email)
            ->executeQuery();

        $user = $result->fetchAssociative();

        if (!$user) {
            return null;
        }

        return User::fill(
            email: $user['email'],
            createdAt: new \DateTimeImmutable($user['created_at']),
            name: $user['name'],
            id: $user['id'],
        );
    }

    public function getAnnouncements(User $user): Collection
    {
        $announcements = new Collection();

        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('a.*')
            ->from('announcement_user', 'au')
            ->join('au', 'announcements', 'a', 'au.announcement_id = a.id')
            ->where('au.user_id = :user_id')
            ->setParameter('user_id', $user->getId());

        $result = $queryBuilder->executeQuery();

        while ($data = $result->fetchAssociative()) {
            $announcement = Announcement::fill(
                price: $data['price'],
                createdAt: new \DateTimeImmutable($data['created_at']),
                url: $data['url'],
                id: $data['id']
            );
            $announcements->add($announcement);
        }

        return $announcements;
    }
}