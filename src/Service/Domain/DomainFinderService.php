<?php 

namespace Src\Service\Domain;

final readonly class DomainFinderService {

    public function find(int $id): array 
    {
        return [
            "id" => $id,
            "name" => "Test name"
        ];
    }

}

