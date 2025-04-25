<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     schema="Habitacion",
 *     type="object",
 *     required={"hotel_id", "tipo_habitacion_id", "acomodacion_id", "cantidad"},
 *     @OA\Property(
 *         property="hotel_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tipo_habitacion_id",
 *         type="integer",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="acomodacion_id",
 *         type="integer",
 *         example=3
 *     ),
 *     @OA\Property(
 *         property="cantidad",
 *         type="integer",
 *         example=5
 *     )
 * )
 */
class HabitacionSchema
{
    
}
