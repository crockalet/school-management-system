<?php

namespace App\Actions;

use App\Exceptions\NotEnoughSlotsException;
use App\Models\Classroom;

class AssignStudentsToClassroom
{
    /**
     * Create a new class instance.
     */
    public function __invoke(Classroom $classroom, array $students)
    {
        $availableSlots = $classroom->max_students - $classroom->students()->count();

        if ($availableSlots <= 0 || $availableSlots < count($students)) {
            throw new NotEnoughSlotsException;
        }

        $classroom->students()->sync($students, detaching: false);
    }
}
