<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Telefonos;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
class TelefonosController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $token = $request->header('Authorization');
        if($token != '')
        
            $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        return Telefonos::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validamos los datos
        $data = $request->only('name', 'price', 'stock');
        $validator = Validator::make($data, [
            'name' => 'required|max:50|string',
            'price' => 'required|max:50|string',
            'stock' => 'required|numeric',
        ]);
        //Si falla la validación
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //Creamos el Telefonoso en la BD
        $Telefonos = Telefonos::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        //Respuesta en caso de que todo vaya bien.
        return response()->json([
            'message' => 'Telefonos created',
            'data' => $Telefonos
        ], Response::HTTP_OK);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telefonos  $Telefonos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Bucamos el Telefonoso
        $Telefonos = Telefonos::find($id);
        //Si el Telefonoso no existe devolvemos error no encontrado
        if (!$Telefonos) {
            return response()->json([
                'message' => 'Telefonos not found.'
            ], 404);
        }
        //Si hay Telefonoso lo devolvemos
        return $Telefonos;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telefonos  $Telefonos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validación de datos
        $data = $request->only('name', 'price', 'stock');
        $validator = Validator::make($data, [
            'name' => 'required|max:50|string',
            'price' => 'required|max:50|string',
            'stock' => 'required|numeric',
        ]);
        //Si falla la validación error.
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //Buscamos el Telefonoso
        $Telefonos = Telefonos::findOrfail($id);
        //Actualizamos el Telefonoso.
        $Telefonos->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        //Devolvemos los datos actualizados.
        return response()->json([
            'message' => 'Telefonos updated successfully',
            'data' => $Telefonos
        ], Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telefonos  $Telefonos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos el Telefonoso
        $Telefonos = Telefonos::findOrfail($id);
        //Eliminamos el Telefonoso
        $Telefonos->delete();
        //Devolvemos la respuesta
        return response()->json([
            'message' => 'Telefonos deleted successfully'
        ], Response::HTTP_OK);
    }
}