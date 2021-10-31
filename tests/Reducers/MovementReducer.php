<?php

declare(strict_types=1);

namespace Circumstax\Framework\Tests\Reducers;

use Circumstax\Framework\ActionContract;
use Circumstax\Framework\ReducerContract;
use Circumstax\Framework\StateAbstract;
use Circumstax\Framework\Tests\Actions\MovementAction;
use Circumstax\Framework\Tests\States\LocationState;
use JetBrains\PhpStorm\Pure;

class MovementReducer implements ReducerContract
{
    /**
     * @param ActionContract|MovementAction $action
     * @param StateAbstract|LocationState $state
     * @return StateAbstract
     */
    #[Pure] public function handle(ActionContract|MovementAction $action, StateAbstract|LocationState $state): StateAbstract
    {
        if ($action->getDirection() === MovementAction::DIRECTION_FORWARD) {
            return new LocationState($state->getX(), $state->getY() + $action->getSteps());
        }

        if ($action->getDirection() === MovementAction::DIRECTION_RIGHT) {
            return new LocationState($state->getX() + $action->getSteps(), $state->getY());
        }

        if ($action->getDirection() === MovementAction::DIRECTION_BACKWARD) {
            return new LocationState($state->getX(), $state->getY() - $action->getSteps());
        }

        if ($action->getDirection() === MovementAction::DIRECTION_LEFT) {
            return new LocationState($state->getX() - $action->getSteps(), $state->getY());
        }

        return $state;
    }
}
