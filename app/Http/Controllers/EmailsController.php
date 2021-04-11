<?php

namespace App\Http\Controllers;

use App\Models\Emails;
use App\Models\Estado;
use Illuminate\Http\Request;
use Auth;

class EmailsController extends Controller
{

    public function __construct()
    {
        //Se exceptua la funcion obtenerEmails para consulto de api público
        $this->middleware('auth',['except' => ['obtenerEmails']]);
    }

    public function index()
    {
        $data = Emails::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(10)->setPath('emails');
        return view('admin.emails.index',compact(['data']));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = Emails::where([['destinatario', 'like', "{$query}%"]])
            ->orWhere([['mensaje', 'like', "{$query}%"]])
            ->orWhere([['estado', 'like', "{$query}%"]])
        ->paginate(10)->setPath('emails');

        return view('admin.emails.index',compact(['data']));
    }

    public function create()
    {
        return view('admin.emails.create');
    }

    public function store(Request $request)
    {
        //Se establecen validaciones desde Backend
        $request->validate([
            'asunto' => ['required', 'string', 'max:255'],
            'destinatario' => ['required', 'string', 'email', 'max:255', 'unique:emails'],
            'mensaje' => ['required', 'string', 'max:1500'],
           ]);

        Emails::create([
            'user_id' => Auth::user()->id,
            'asunto' => $request['asunto'],
            'destinatario' => $request['destinatario'],
            'mensaje' => $request['mensaje'],

        ]);

        return redirect('emails')->with('success','Email creado correctamente');
    }

    public function show($id)
    {
       $data =  Emails::find($id);
       return view('admin.emails.show',compact(['data']));
    }

    public function edit($id)
    {
       $data = Emails::find($id);
       return view('admin.emails.edit',compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
           ]);

        Emails::where('id',$id)->update($input);
        return redirect()->route('emails.edit', $id)->with('success','Email Actualizado.');

    }

    public function destroy($id)
    {
        Emails::where('id',$id)->delete();
        return redirect()->back()->with('success','Email Eliminado Correctamente.');
    }

    //Api rest publica para obtener emails
    public function obtenerEmails(Request $request)
    {
        $mensaje =  new \stdClass();
        $mensaje->error =  true;
        $mensaje->data =  "";

        if(!$request['remitente'] && !$request['destinatario'] && !$request['asunto']){
            $mensaje->data =  "No se envió ninguna filtro (remitente, destinatario, asunto)";
            return response()->json($mensaje);
        }else{
            try {
                $data = Emails::join('users', 'users.id', '=', 'emails.user_id')
                    ->join('ciudad', 'ciudad.id', '=', 'users.ciudad')
                    ->select()
                    ->select(\DB::raw('users.name as nombre,
                        users.email as email_remitente,
                        users.celular,
                        TIMESTAMPDIFF(YEAR, users.fecha_nacimiento, CURDATE()) AS edad,
                        ciudad.name as ciudad, emails.destinatario, emails.mensaje,
                        emails.asunto')
                    )
                    ->where('users.email', $request['remitente'])
                    ->orWhere('emails.destinatario', $request['destinatario'])
                    ->orWhere('emails.asunto', $request['asunto'])
                    ->orderBy('emails.created_at','asc')->paginate(10);

                $mensaje->error =  false;
                $mensaje->data =  $data;
            }catch (\Exception $e){
                $mensaje->error =  true;
                $mensaje->data =  $e;
            }
        }

        return response()->json($mensaje);
    }

}
