<?php

namespace App\Http\Controllers;

use App\Models\EstudianteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Test\TestStubCreated;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = EstudianteModel::all();

        if ($estudiantes->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($estudiantes, 200);
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'cod' => 'required|unique:estudiantes',
            'nombres' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student = EstudianteModel::create([
            'cod' => $request->cod,
            'nombres' => $request->nombres,
            'email' => $request->email
        ]);

        if (!$student) {
            $data = [
                'message' => 'Error al crear estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($cod)
    {
        $student = EstudianteModel::find($cod);

        if (!$student) {
            $data = [
                'messague' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($cod)
    {
        $student = EstudianteModel::find($cod);

        if (!$student) {
            $data = [
                'messague' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $student->delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $cod)
    {
        $student = EstudianteModel::find($cod);

        if (!$student) {
            $data = [
                'messague' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator =  Validator::make($request->all(), [
            'cod' => 'required|unique:estudiantes',
            'nombres' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student->cod = $request->cod;
        $student->nombres = $request->nombres;
        $student->email = $request->email;

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
