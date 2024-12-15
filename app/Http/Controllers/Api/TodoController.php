<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends BaseController
{
    public function getTodos()
    {
        $todos = Todo::all();
        return $this->sendResponse($todos, 'Todos retrieved successfully.');
    }

    public function addTodo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'todo_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $todo = Todo::create($request->all());
        return $this->sendResponse($todo, 'Todo created successfully.');
    }

    public function getSingleTodo(string $id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) {
            return $this->sendError(
                'Todo not found.',
                ['id' => 'Todo not found.'],
            );
        }

        return $this->sendResponse($todo, 'Todo retrieved successfully.');
    }

    public function updateTodo(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'todo_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $todo = Todo::find($id);

        if (is_null($todo)) {
            return $this->sendError('Todo not found.', [
                'id' => 'Todo not found.',

            ]);
        }

        $todo->update($request->all());
        return $this->sendResponse($todo, 'Todo updated successfully.');
    }

    public function deleteTodo(string $id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) {
            return $this->sendError(
                'Todo not found.',
                ['id' => 'Todo not found.'],
            );
        }

        $todo->delete();
        return $this->sendResponse(null, 'Todo deleted successfully.');
    }
}
