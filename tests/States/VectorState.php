<?php

declare(strict_types=1);

namespace Circumstax\Framework\Tests\States;

use Circumstax\Framework\StateAbstract;

class VectorState extends StateAbstract
{
    protected string $parentStateClass = self::class;

    protected int $x;
    protected int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}
