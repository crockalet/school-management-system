<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'section',
        'max_students',
    ];

    public function casts()
    {
        return [
            'max_students' => 'integer',
        ];
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function canAssignStudents(int $student_count)
    {
        $availableSlots = $this->max_students - $this->students()->count();

        return $availableSlots > 0 && $availableSlots >= $student_count;
    }

}
