<?php

namespace Core\BusinessRules\Income;

interface DeleteInterface
{
    public function delete(int $id): void;
}