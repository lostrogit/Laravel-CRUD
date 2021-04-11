<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('can:isAdmin');
    }

    public function index()
    {

        $data = User::sortable()->paginate(10)->setPath('usuarios');
        return view('admin.usuarios.index',compact(['data']));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $data = User::where([['name', 'like', "{$query}%"]])
                ->orWhere([['cedula', 'like', "{$query}%"]])
                ->orWhere([['email', 'like', "{$query}%"]])
                ->orWhere([['celular', 'like', "{$query}%"]])
                ->paginate(10)->setPath('usuarios');

        return view('admin.usuarios.index',compact(['data']));
    }

    private function getRoles()
    {
        $result = DB::select("SHOW COLUMNS FROM `usuarios` LIKE 'role';");
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $result[0]->Type, $enum_array );
        return $enum_fields = $enum_array[1];
    }

    private function getPaises()
    {
        $paises = Pais::get(["name", "id"]);
        return $paises;
    }

    public function create()
    {

        return view('admin.usuarios.create')->with('roles', $this->getRoles() );
    }

    public function store(Request $request)
    {

        //Se establecen validaciones desde Backend
        $request->validate([
            'role' => ['in:admin,manager,user,editor'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           ]);


        User::create([
            'role' => $request['role'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('usuarios')->with('success','Create Successfully');
    }

    public function show($id)
    {
       $data =  User::find($id);
       return view('admin.usuarios.show',compact(['data']));
    }

    public function edit($id)
    {
       $data = User::find($id);
       $paises = $this->getPaises();
       return view('admin.usuarios.edit',compact(['data','paises']));
    }

    public function update(Request $request, $id)
    {

        //Se establecen validaciones desde Backend
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'celular' => ['max:10'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:'.\Carbon\Carbon::now()->subYears(18)->format('d/m/Y')],
            'ciudad' => ['required']
        ]);

        //Se valida si viene el campo password vacio, caso contrario se valida y almacena nuevo
        if( !empty( $request->input('password') ))
        {
            $data['password'] = Hash::make($request->input('password'));

            $request->validate([
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ]);
        }

        $data['name'] = $request->input('name');
        $data['celular'] = $request->input('celular');
        $data['fecha_nacimiento'] = $request->input('fecha_nacimiento');
        $data['ciudad'] = $request->input('ciudad');
        $data['email'] = $request->input('email');

        User::where('id',$id)->update( $data);
        return redirect('usuarios')->with('success','Usuario Actualizado correctamente');

    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('success','Usuario Eliminado Correctamente');
    }

}
