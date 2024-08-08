<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Interfaces\AppointmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(
 *      title="API Appointment Swagger",
 *      version="1.0",
 *      description="API CRUD Appointment"
 * )
 *
 * @OA\Server(url="http://localhost:8000")
 */

class AppointmentController extends Controller
{
    private AppointmentRepositoryInterface $appointmentRepositoryInterface;

    public function __construct(AppointmentRepositoryInterface $appointmentRepositoryInterface)
    {
        $this->appointmentRepositoryInterface = $appointmentRepositoryInterface;
    }

    /**
     * @OA\Get(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Get list of appointments",
     *     description="Return list of appointments",
     *     @OA\Response(
     *         response=200,
     *         description="Succesful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AppointmentResource")
     *         )
     *      )
     * )
     */
    public function index()
    {
        $data = $this->appointmentRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(AppointmentResource::collection($data), '', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Get appointments information",
     *     description="Get appointment details by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AppointmentResource")
     *     )
     * )
     */
    public function show($id)
    {
        $student = $this->appointmentRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new AppointmentResource($student), '', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Create new appointment",
     *     description="Create a new appointment record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_name", type="string", example="John Doe"),
     *             @OA\Property(property="doctor_name", type="string", example="Sam Jame"),
     *             @OA\Property(property="appointment_date", type="datetime", example="2024-08-05 07:30:00"),
     *             @OA\Property(property="status", type="string", example="scheduled")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Record created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/AppointmentResource")
     *     )
     * )
    */
    public function store(StoreAppointmentRequest $request)
    {
        $data = [
            'patient_name' => $request->patient_name,
            'doctor_name' => $request->doctor_name,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new AppointmentResource($appointment), 'Record create succesful', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Update appointment information",
     *     description="Update appointment record by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_name", type="string", example="John Doe"),
     *             @OA\Property(property="doctor_name", type="string", example="Sam Jame"),
     *             @OA\Property(property="appointment_date", type="datetime", example="2024-08-05 07:30:00"),
     *             @OA\Property(property="status", type="string", example="scheduled")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/AppointmentResource")
     *     )
     * )
     */
    public function update(UpdateAppointmentRequest $request, string $id)
    {
        $student = $this->appointmentRepositoryInterface->getById($id);

        if($student == null){
            return ApiResponseHelper::sendResponse(null, 'Record no ' + $id + ' fount', 200, false);
        }

        $data = [
            'patient_name' => $request->patient_name,
            'doctor_name' => $request->doctor_name,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record update succesful', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Delete appointment record",
     *     description="Delete appointment by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record deleted successfully"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $this->appointmentRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Record deleted succesful', 200);
    }
}
