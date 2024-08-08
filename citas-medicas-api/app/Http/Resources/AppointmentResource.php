<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="AppointmentResource",
     *     type="object",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="Id of the Appointment"
     *     ),
     * *   @OA\Property(
     *         property="patient_name",
     *         type="string",
     *         description="patient name of the Appointment"
     *     ),
     * *   @OA\Property(
     *         property="doctor_name",
     *         type="string",
     *         description="doctor name of the Appointment"
     *     ),
     * *   @OA\Property(
     *         property="appointment_date",
     *         type="datetime",
     *         description="dateof the  Appointment"
     *     ),
     * *   @OA\Property(
     *         property="status",
     *         type="string",
     *         description="status the  Appointment"
     *     )
     * )
    */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'patient_name' => $this->patient_name,
            'doctor_name' => $this->doctor_name,
            'appointment_date'=> $this->appointment_date,
            'status' => $this->status
        ];
    }
}
