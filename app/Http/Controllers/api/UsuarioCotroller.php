<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioCotroller extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        try {
            $usuarios = DB::select('SELECT u.*, r.rol_nombre FROM usuarios u INNER JOIN roles r ON u.rol_id = r.rol_id');

            return response()->json([
                'success' => true,
                'usuarios' => $usuarios
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Obtener un usuario
    public function show($id)
    {
        try {
            $usuario = DB::table('usuarios')->where('usuario_id', $id)->first();

            return response()->json([
                'success' => true,
                'usuario' => $usuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Crear un usuario
    public function store(Request $request)
    {
        try {
            $usuario = DB::table('usuarios')->where('usuario_nombre', $request->nombre)->first();

            if ($usuario) {
                return response()->json([
                    'success' => false,
                    'message' => '¡El usuario ya existe!'
                ], 500);
            }

            DB::table('usuarios')->insert([
                'usuario_nombre' => $request->nombre,
                'usuario_apellidos' => $request->apellidos,
                'usuario_correo' => $request->correo,
                'rol_id' => $request->rol,
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Usuario creado correctamente!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        try {
            $usuario = DB::table('usuarios')->where('usuario_id', $id)->first();

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => '¡El usuario no existe!'
                ], 500);
            }

            $usuario = DB::select('SELECT * FROM usuarios WHERE usuario_nombre = ? AND usuario_id != ?', [$request->nombre, $id]);

            if ($usuario) {
                return response()->json([
                    'success' => false,
                    'message' => '¡El usuario ya existe!'
                ], 500);
            }

            DB::table('usuarios')->where('usuario_id', $id)->update([
                'usuario_nombre' => $request->nombre,
                'usuario_apellidos' => $request->apellidos,
                'usuario_correo' => $request->correo,
                'rol_id' => $request->rol,
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Usuario actualizado correctamente!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        try {
            $usuario = DB::table('usuarios')->where('usuario_id', $id)->first();

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => '¡El usuario no existe!'
                ], 500);
            }

            DB::table('usuarios')->where('usuario_id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => '¡Usuario eliminado correctamente!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
