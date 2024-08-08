<?php

namespace App\Repositories;

use App\Interfaces\AppointmentRepositoryInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentRepositoryInterface
{
   public function getAll(){
    return Appointment::all();
   }

   public function getById($id){
    return Appointment::findOrFail($id);
   }

   public function store(array $data){
    return Appointment::create($data);
   }

   public function update(array $data, $id){
    return Appointment::whereId($id)->update($data);
   }

   public function delete($id){
    return Appointment::destroy($id);
   }

}
