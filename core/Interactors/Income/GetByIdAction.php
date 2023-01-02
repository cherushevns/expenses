<?php

namespace Core\Interactors\Income;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Income\Entity\Income;
use Core\BusinessRules\Income\GetByIdInterface;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeRepository;
use Core\Interactors\Income\Model\IncomeModel;

class GetByIdAction implements GetByIdInterface
{
    public function __construct(
        private IncomeRepository $incomeRepository,
        private IncomeModel $incomeModel,
        private GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {}

    public function get(int $id): ?Income
    {
        $incomeEntity = $this->incomeRepository->getByIdAndUserId(
            $id,
            $this->getAuthorizedUserId->get()
        );

        return $incomeEntity ? $this->incomeModel->toBusiness($incomeEntity) : null;
    }
}