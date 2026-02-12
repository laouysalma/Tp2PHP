<?php
declare(strict_types=1);

namespace App\Repository;

interface RepositoryInterface
{
    public function findAll();
    public function findById(int $id);
    public function save($entity): void;
    public function delete(int $id): void;
}