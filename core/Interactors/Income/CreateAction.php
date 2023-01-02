<?php

namespace Core\Interactors\Income;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Income\CreateInterface;
use Core\BusinessRules\Income\Entity\Income;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeRepository;
use Core\Interactors\Income\Model\IncomeModel;

class CreateAction implements CreateInterface
{
    public function __construct(
        private IncomeModel $incomeModel,
        private IncomeRepository $incomeRepository,
        private GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {}

    public function create(Income $income): void
    {
        $income->setUserId($this->getAuthorizedUserId->get());

        $this->incomeRepository->create(
            $this->incomeModel->toData($income)
        );
    }
}