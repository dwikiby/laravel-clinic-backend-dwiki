<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    // index
    public function index(Request $request)
    {
        $doctors = DB::table('doctors')
            ->when($request->input('doctor_name'), function ($query, $doctor_name) {
                return $query->where('doctor_name', 'like', '%' . $doctor_name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.doctors.index', compact('doctors'));

    }

    public function create()
    {
        return view('pages.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required',
            'sip' => 'required',
            'doctor_email' => 'required|email',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_address' => 'required',
        ]);
        $doctor = new \App\Models\Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->sip = $request->sip;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_address = $request->doctor_address;


        if ($request->hasFile('doctor_photo')) {
            $image = $request->file('doctor_photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke disk publik
            $path = $image->storeAs('upload/doctor_photos', $name_gen, 'public');
            $save_url = '/storage/' . $path;

            $doctor->doctor_photo = $save_url;
        }

        $doctor->save();
        return redirect()->route('doctor.index')->with('success', 'Create doctor successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('pages.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name' => 'required',
            'sip' => 'required',
            'doctor_email' => 'required|email',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_address' => 'required',
        ]);
        $doctor = Doctor::find($id);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->sip = $request->sip;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_address = $request->doctor_address;

        if ($request->hasFile('doctor_photo')) {
            // delete old image
            if (File::exists(public_path($doctor->doctor_photos))) {
                File::delete(public_path($doctor->doctor_photos));
            }
            // upload new image
            $image = $request->file('doctor_photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke disk publik
            $path = $image->storeAs('upload/doctor_photos', $name_gen, 'public');
            $save_url = '/storage/' . $path;

            $doctor->doctor_photo = $save_url;
        }
        $doctor->save();
        return redirect()->route('doctor.index')->with('success', 'Update doctor successfully.');
    }

    // destroy
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        // find image doctor
        $image_path = public_path($doctor->doctor_photo);

        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $doctor->delete();
        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully.');
    }
}
