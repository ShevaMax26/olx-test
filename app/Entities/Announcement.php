<?php

namespace App\Entities;

class Announcement
{
    public function __construct(
        private ?int               $id,
        private ?string             $url,
        private ?int               $price,
        private \DateTimeImmutable $createdAt
    )
    {
    }

    public static function fill(?int $price, ?\DateTimeImmutable $createdAt = null, string $url = null, int $id = null): static
    {
        return new static($id, $url, $price, $createdAt ?? new \DateTimeImmutable());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
