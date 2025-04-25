<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Usuarios",
 *     description="Operaciones relacionadas con los usuarios"
 * )
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Obtener el usuario autenticado",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *         response=200,
     *         description="Información del usuario autenticado",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado"
     *     )
     * )
     */
    public function getUser(Request $request)
    {
        // Retorna la información del usuario autenticado
        return response()->json($request->user());
    }
}
