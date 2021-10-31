<?php

declare(strict_types=1);

namespace Circumstax\Tests;

use Circumstax\StateAbstract;
use Circumstax\Store;
use Circumstax\Tests\Actions\MovementAction;
use Circumstax\Tests\Reducers\MovementReducer;
use Circumstax\Tests\States\LocationState;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase
{
    public function test_if_a_store_returns_the_same_state_as_we_put_in(): void
    {
        $state = new LocationState(0, 0);
        $store = new Store(new MovementReducer(), $state);

        /** @var LocationState $state */
        $compareState = $store->getState();

        self::assertTrue($state->is($compareState));
    }

    public function test_if_store_dispatches_an_action()
    {
        $state = new LocationState(0, 0);
        $store = new Store(new MovementReducer(), $state);

        $store->dispatch(new MovementAction(MovementAction::DIRECTION_FORWARD, 3));

        self::assertTrue((new LocationState(0, 3))->is($store->getState()));
    }

    public function test_if_store_after_a_dispatch_triggers_all_the_listeners()
    {
        $state = new LocationState(0, 0);
        $store = new Store(new MovementReducer(), $state);

        $store->listener(function (StateAbstract $state) use (&$aIsAsserted) {
            $aIsAsserted = true;
            self::assertTrue((new LocationState(0, 3))->is($state));
        });

        $store->listener(function (StateAbstract $state) use (&$bIsAsserted) {
            $bIsAsserted = true;
            self::assertTrue((new LocationState(0, 3))->is($state));
        });

        $store->dispatch(new MovementAction(MovementAction::DIRECTION_FORWARD, 3));

        self::assertTrue($aIsAsserted);
        self::assertTrue($bIsAsserted);
    }
}
