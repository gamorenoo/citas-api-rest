<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="AuthResource",
     *     type="object",
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="name user"
     *     ),
     * *   @OA\Property(
     *         property="email",
     *         type="string",
     *         description="email user"
     *     ),
     * *   @OA\Property(
     *         property="password",
     *         type="string",
     *         description="password user"
     *     )
     * )
    */
    public function toArray(Request $request): array
    {
        return[
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
