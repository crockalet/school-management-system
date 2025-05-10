<?php

namespace App\Http\Controllers;

use App\Actions\CanAssignStudentsToClassroom;
use App\Exceptions\NotEnoughSlotsException;
use App\Http\Resources\StudentResource;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\ValidationException;

/**
 * @tags Classes
 */
class ClassroomStudentsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:update,classroom', only: ['assign', 'unassign']),
        ];
    }

    /**
     * Assign students to a class
     */
    public function assign(Request $request, Classroom $classroom, CanAssignStudentsToClassroom $assignStudentsToClassroom)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,id',
        ]);

        if (! $classroom->canAssignStudents(count($request->students))) {
            throw ValidationException::withMessages([
                'students' => 'Not enough slots available in this class.',
            ]);
        }

        $classroom->students()->sync($request->students, detaching: false);

        return response()->json([
            'message' => 'Students assigned successfully.',
            'students' => StudentResource::collection($classroom->students()->get()),
        ]);
    }

    /**
     * Remove students from a class
     */
    public function unassign(Request $request, Classroom $classroom)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,id',
        ]);

        $classroom->students()->detach($request->students);

        return response()->json([
            'message' => 'Students unassigned successfully.',
            'students' => StudentResource::collection($classroom->students()->get()),
        ]);
    }
}
