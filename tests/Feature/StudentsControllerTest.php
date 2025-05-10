<?php

use App\Models\Student;

it('can create a student', function () {
    $this->actingAsAdmin();

    $data = Student::factory()->make();

    $this->postJson(route('students.store'), $data->toArray())
        ->assertCreated()
        ->assertJson([
            'data' => [
                'name' => $data->name,
                'email' => $data->email,
            ],
        ]);

    $this->assertDatabaseHas(Student::class, [
        'name' => $data->name,
        'email' => $data->email,
    ]);
});
