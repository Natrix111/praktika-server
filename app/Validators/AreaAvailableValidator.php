<?php

namespace Validators;

use Model\Building;
use Src\Validator\AbstractValidator;

class AreaAvailableValidator extends AbstractValidator
{
    protected string $message = 'В здании недостаточно свободной площади';

    public function rule(): bool
    {
        $building = Building::find($this->args[0]);

        if (!$building) {
            return false;
        }

        $usedArea = $building->rooms()->sum('area');
        $availableArea = $building->area - $usedArea;

        return $this->value <= $availableArea;
    }
}