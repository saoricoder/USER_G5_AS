<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        return response()->json(['data' => $usuarios], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Usar los datos validados y asegurar que la contraseña quede encriptada
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $usuario = User::create($data);

        return response()->json(['message' => 'Usuario creado exitosamente', 'data' => $usuario], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        return response()->json(['data' => $usuario], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        $data = $request->validated();

    // Actualizar la contraseña solo si se proporciona
    if (isset($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    }

    $usuario->update($data);

    return response()->json(['message' => 'Usuario actualizado exitosamente', 'data' => $usuario], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->noContent();
    }
}
