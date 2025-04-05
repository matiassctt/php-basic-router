<?php 

declare(strict_types = 1);

namespace Src\Insfrastructure\Domain;

final readonly class DomainRepository {

    public function find(int $id): array 
    {
        return [
            "id" => $id,
            "name" => "Test name"
        ];
    }

}