<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\TipoHabitacion;
use App\Models\Acomodacion;

/**
 * @OA\Tag(
 *     name="Habitaciones",
 *     description="Operaciones relacionadas con las habitaciones"
 * )
 */
class HabitacionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/habitaciones",
     *     summary="Listar todas las habitaciones",
     *     tags={"Habitaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de habitaciones",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Habitacion")
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
        return response()->json(Habitacion::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/habitaciones/{id}",
     *     summary="Mostrar una habitación específica",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la habitación",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitación encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Habitacion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        $habitacion = Habitacion::find($id);
        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }
        return response()->json($habitacion, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/habitaciones",
     *     summary="Crear una nueva habitación",
     *     tags={"Habitaciones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"hotel_id", "tipo_habitacion_id", "acomodacion_id", "cantidad"},
     *             @OA\Property(property="hotel_id", type="integer", example=1),
     *             @OA\Property(property="tipo_habitacion_id", type="integer", example=2),
     *             @OA\Property(property="acomodacion_id", type="integer", example=3),
     *             @OA\Property(property="cantidad", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Habitación creada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/Habitacion")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Acomodación no válida para el tipo de habitación"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $tipoHabitacion = TipoHabitacion::find($request->tipo_habitacion_id);
        $acomodacion = Acomodacion::find($request->acomodacion_id);

        $reglasNegocio = [
            'Estándar' => ['Sencilla', 'Doble'],
            'Junior' => ['Triple', 'Cuádruple'],
            'Suite' => ['Sencilla', 'Doble', 'Triple']
        ];

        if (!in_array($acomodacion->nombre, $reglasNegocio[$tipoHabitacion->nombre])) {
            return response()->json(['error' => 'Acomodación no válida para el tipo de habitación'], 400);
        }

        $habitacion = Habitacion::create($request->all());
        return response()->json(['message' => 'Habitación creada con éxito', 'data' => $habitacion], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/habitaciones/{id}",
     *     summary="Actualizar una habitación",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la habitación",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="hotel_id", type="integer", example=1),
     *             @OA\Property(property="tipo_habitacion_id", type="integer", example=2),
     *             @OA\Property(property="acomodacion_id", type="integer", example=3),
     *             @OA\Property(property="cantidad", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitación actualizada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/Habitacion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $habitacion = Habitacion::find($id);
        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        $request->validate([
            'hotel_id' => 'exists:hoteles,id',
            'tipo_habitacion_id' => 'exists:tipos_habitacion,id',
            'acomodacion_id' => 'exists:acomodaciones,id',
            'cantidad' => 'integer|min:1',
        ]);

        $habitacion->update($request->all());
        return response()->json(['message' => 'Habitación actualizada con éxito', 'data' => $habitacion], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/habitaciones/{id}",
     *     summary="Eliminar una habitación",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la habitación",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitación eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::find($id);
        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        $habitacion->delete();
        return response()->json(['message' => 'Habitación eliminada con éxito'], 200);
    }
}
