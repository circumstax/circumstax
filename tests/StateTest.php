<?php

declare(strict_types=1);

namespace Circumstax\Tests;

use Circumstax\StateAbstract;
use Circumstax\Tests\States\Bar;
use Circumstax\Tests\States\Foo;
use Circumstax\Tests\States\LocationState;
use Circumstax\Tests\States\NotEqualLocationState;
use Circumstax\Tests\States\VectorState;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @param StateAbstract $state
     * @param StateAbstract $comparingState
     *
     * @dataProvider equalStateDataProvider
     */
    public function test_if_the_state_is_equal(StateAbstract $state, StateAbstract $comparingState): void
    {
        self::assertTrue($state->is($comparingState));
    }

    #[Pure] public function equalStateDataProvider(): array
    {
        $locationState = new LocationState(0, 0);
        return [
            [
                'state' => $locationState,
                'compareState' => $locationState,
            ],
            [
                'state' => new LocationState(0, 0),
                'compareState' => new LocationState(0, 0),
            ],
            [
                'state' => new LocationState(0, 0),
                'compareState' => new VectorState(0, 0),
            ],
            [
                'state' => new LocationState(0, 0),
                'compareState' => new NotEqualLocationState(0, 0),
            ],
        ];
    }

    /**
     * @param StateAbstract $state
     * @param StateAbstract $comparingState
     *
     * @dataProvider notEqualStateDataProvider
     */
    public function test_if_the_state_is_not_equal(StateAbstract $state, StateAbstract $comparingState): void
    {
        self::assertFalse($state->is($comparingState));
    }

    #[Pure] public function notEqualStateDataProvider(): array
    {
        return [
            [
                'state' => new LocationState(0, 0),
                'compareState' => new LocationState(0, 1),
            ],
            [
                'state' => new LocationState(0, 0),
                'compareState' => new VectorState(1, 0),
            ],
            [
                'state' => new LocationState(1, 1),
                'compareState' => new LocationState(0, 0),
            ],
            [
                'state' => new NotEqualLocationState(0, 0),
                'compareState' => new LocationState(0, 0),
            ],
            [
                'state' => new Foo(),
                'compareState' => new Bar(),
            ],
        ];
    }
}
