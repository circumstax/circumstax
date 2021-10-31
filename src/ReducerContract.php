<?php

declare(strict_types=1);

namespace Circumstax\Framework;

interface ReducerContract
{
    public function handle(ActionContract $action, StateAbstract $state): StateAbstract;
}
