<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StudentsController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,App\Models\Student', only: ['index']),
            new Middleware('can:create,App\Models\Student', only: ['store']),
            new Middleware('can:view,student', only: ['show']),
            new Middleware('can:update,student', only: ['update']),
            new Middleware('can:delete,student', only: ['destroy']),
        ];
    }

    /**
     * Get all students.
     * 
     * @response AnonymousResourceCollection<LengthAwarePaginator<StudentResource>>
     */
    public function index()
    {
        return StudentResource::collection(Student::paginate(24));
    }

    /**
     * Create a new student.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return new StudentResource($student);
    }

    /**
     * Get a student.
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update a student.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    /**
     * Delete a student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }
}
