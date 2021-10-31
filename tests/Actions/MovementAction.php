<?php

declare(strict_types=1);

namespace Circumstax\Framework\Tests\Actions;

use Circumstax\Framework\ActionContract;

class MovementAction implements ActionContract
{
    public const DIRECTION_FORWARD = 'F';
    public const DIRECTION_RIGHT = 'L';
    public const DIRECTION_BACKWARD = 'B';
    public const DIRECTION_LEFT = 'R';

    /**
     * @var string
     */
    private string $direction;

    /**
     * @var int
     */
    private int $steps;

    /**
     * MovementAction constructor.
     *
     * @param string $direction
     * @param int $steps
     */
    public function __construct(string $direction, int $steps)
    {
        $this->direction = $direction;
        $this->steps = $steps;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getSteps(): int
    {
        return $this->steps;
    }
}
