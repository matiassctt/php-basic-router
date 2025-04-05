<?php 

declare(strict_types = 1);

namespace Src\Insfrastructure\Domain;

interface DomainRepositoryInterface {
    public function find(int $id): array;
}