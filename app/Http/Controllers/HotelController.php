<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Hoteles",
 *     description="Operaciones relacionadas con los hoteles"
 * )
 */

class HotelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hoteles",
     *     summary="Listar todos los hoteles",
     *     tags={"Hoteles"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de hoteles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Hotel")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en el servidor"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Hotel::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/hoteles/{id}",
     *     summary="Mostrar un hotel específico",
     *     tags={"Hoteles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del hotel",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Hotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }
        return response()->json($hotel, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/hoteles",
     *     summary="Crear un nuevo hotel",
     *     tags={"Hoteles"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "direccion", "ciudad", "nit"},
     *             @OA\Property(property="nombre", type="string", example="Hotel Test"),
     *             @OA\Property(property="direccion", type="string", example="Calle Ficticia 123"),
     *             @OA\Property(property="ciudad", type="string", example="Ciudad Ejemplo"),
     *             @OA\Property(property="nit", type="string", example="123456789")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hotel creado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/Hotel")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:hoteles',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'nit' => 'required|string|unique:hoteles',
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Crear el hotel
        $hotel = Hotel::create($request->all());

        // Devolver respuesta con el hotel creado
        return response()->json([
            'mensaje' => 'Hotel creado con éxito',
            'hotel' => $hotel
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/hoteles/{id}",
     *     summary="Actualizar un hotel",
     *     tags={"Hoteles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del hotel",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="Hotel Actualizado"),
     *             @OA\Property(property="direccion", type="string", example="Nueva Calle 456"),
     *             @OA\Property(property="ciudad", type="string", example="Nueva Ciudad"),
     *             @OA\Property(property="nit", type="string", example="987654321")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel actualizado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/Hotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'string|unique:hoteles,nombre,' . $id,
            'direccion' => 'string',
            'ciudad' => 'string',
            'nit' => 'string|unique:hoteles,nit,' . $id,
        ]);

        $hotel->update($request->all());
        return response()->json(['message' => 'Hotel actualizado con éxito', 'data' => $hotel], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/hoteles/{id}",
     *     summary="Eliminar un hotel",
     *     tags={"Hoteles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del hotel",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel eliminado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $hotel->delete();
        return response()->json(['message' => 'Hotel eliminado con éxito'], 200);
    }
}
