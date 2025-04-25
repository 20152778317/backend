<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     schema="Hotel",
 *     type="object",
 *     required={"id", "nombre", "ubicacion", "descripcion"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Hotel Paraíso"),
 *     @OA\Property(property="ubicacion", type="string", example="Calle Ficticia 123"),
 *     @OA\Property(property="descripcion", type="string", example="Hotel de 5 estrellas con vista al mar")
 * )
 */
class HotelSchema
{
    
}
