<?php 

declare(strict_types = 1);

namespace Src\Service\Domain;

use Src\Insfrastructure\Domain\DomainRepository;

final readonly class DomainFinderService {

    private DomainRepository $domainRepository;

    public function __construct() 
    {
        $this->domainRepository = new DomainRepository();
    }

    public function find(int $id): array 
    {
        return $this->domainRepository->find($id);
    }

}

