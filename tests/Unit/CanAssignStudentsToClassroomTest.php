<?php

use App\Models\Classroom;
use App\Models\Student;

test('can assign students to a classroom if there are enough slots', function () {
    $classroom = Classroom::factory()->create([
        'max_students' => 1,
    ]);

    expect($classroom->canAssignStudents(1))->toBeTrue();

    $classroom->students()->attach(Student::factory()->create()->id);

    expect($classroom->canAssignStudents(1))->toBeFalse();
});