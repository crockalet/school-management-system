<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\StoreClassroomRequest;
use App\Http\Requests\Classroom\UpdateClassroomRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

/**
 * @tags Classes
 */
class ClassroomsController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,App\Models\Classroom', only: ['index']),
            new Middleware('can:create,App\Models\Classroom', only: ['store']),
            new Middleware('can:view,classroom', only: ['show']),
            new Middleware('can:update,classroom', only: ['update']),
            new Middleware('can:delete,classroom', only: ['destroy']),
        ];
    }

    /**
     * Get all classes
     * 
     * @response AnonymousResourceCollection<LengthAwarePaginator<ClassroomResource>>
     */
    public function index()
    {
        return ClassroomResource::collection(Classroom::query()->withCount('students')->paginate(perPage: 12));
    }

    /**
     * Create a new class
     */
    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->validated());

        return new ClassroomResource($classroom);
    }

    /**
     * List a class with students
     */
    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom->load(['students']));
    }

    /**
     * Update a class
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        return new ClassroomResource($classroom);
    }

    /**
     * Delete a class
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json([
            'message' => 'Class deleted successfully',
        ]);
    }
}
