<?php

namespace Core\UseCase\Income;

use Core\BusinessRules\Income\DeleteInterface;

class DeleteUseCase
{
    public function __construct(
        private DeleteInterface $delete
    ) {}

    public function delete(int $id): void
    {
        $this->delete->delete($id);
    }
}