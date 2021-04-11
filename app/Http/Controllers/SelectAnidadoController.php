<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Response;
use Redirect;
use App\Models\{Pais, Estado, Ciudad};

class SelectAnidadoController extends Controller
{
    //Obtiene listado de paises
    public function index()
    {
        $data['paises'] = Pais::get(["name", "id"]);
        return view('welcome', $data);
    }

    //Obtiene listado de estados segun seleccion de país
    public function obtenerEstados(Request $request)
    {
        $data['estados'] = Estado::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    //Obtiene listado de ciudades segun seleccion de estado
    public function obtenerCiudades(Request $request)
    {
        $data['ciudades'] = Ciudad::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
