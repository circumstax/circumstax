<?php

declare(strict_types=1);

namespace Circumstax;

class Store
{
    /**
     * @var ReducerContract
     */
    private ReducerContract $reducer;

    /**
     * @var array
     */
    private array $listeners = [];

    /**
     * @var StateAbstract
     */
    private StateAbstract $state;

    /**
     * Store constructor.
     *
     * @param ReducerContract $reducer
     * @param StateAbstract $state
     */
    public function __construct(ReducerContract $reducer, StateAbstract $state)
    {
        $this->reducer = $reducer;
        $this->state = $state;
    }

    /**
     * @return StateAbstract
     */
    public function getState(): StateAbstract
    {
        return $this->state;
    }

    /**
     * @param ActionContract $action
     */
    public function dispatch(ActionContract $action): void
    {
        $newState = $this->reducer->handle($action, $this->state);

        if ($this->state->is($newState)) {
            return;
        }

        $this->state = $newState;

        foreach ($this->listeners as $listener) {
            $listener($this->state);
        }
    }

    /**
     * @param callable $listener
     */
    public function listener(callable $listener): void
    {
        $this->listeners[] = $listener;
    }
}
