<?php

declare(strict_types=1);

namespace Circumstax\Framework;

use ReflectionClass;

abstract class StateAbstract
{
    protected string $parentStateClass;

    public function is(StateAbstract $comparingState): bool
    {
        if ($this === $comparingState) {
            return true;
        }

        if (!($comparingState instanceof ($this->parentStateClass ?? static::class))) {
            return false;
        }

        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        $reflectionComparingState = new ReflectionClass($comparingState);
        $propertiesComparingState = $reflectionComparingState->getProperties();

        $mappedPropertiesComparingState = [];
        foreach ($propertiesComparingState as $property) {
            $key = $property->getName();

            if ($key === 'parentStateClass') {
                continue;
            }

            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            $mappedPropertiesComparingState[$key] = $property->getValue($comparingState);
        }

        foreach ($properties as $property) {
            $key = $property->getName();

            if ($key === 'parentStateClass') {
                continue;
            }

            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            if (!isset($mappedPropertiesComparingState[$key])) {
                return false;
            }

            if ($property->getValue($this) !== $mappedPropertiesComparingState[$key]) {
                return false;
            }
        }

        return true;
    }
}
