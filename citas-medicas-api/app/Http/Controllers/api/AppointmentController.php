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

class AppointmentController extends Controller
{
    private AppointmentRepositoryInterface $appointmentRepositoryInterface;

    public function __construct(AppointmentRepositoryInterface $appointmentRepositoryInterface)
    {
        $this->appointmentRepositoryInterface = $appointmentRepositoryInterface;
    }

    public function index()
    {
        $data = $this->appointmentRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(AppointmentResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $student = $this->appointmentRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new AppointmentResource($student), '', 200);
    }

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

    public function destroy(string $id)
    {
        $this->appointmentRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Record deleted succesful', 200);
    }
}
