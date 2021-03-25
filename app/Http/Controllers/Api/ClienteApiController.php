<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterApiController;
use App\Models\Cliente;
use App\Models\Telefone;

class ClienteApiController extends MasterApiController
{
    protected $model;
    protected $path = 'clientes';
    protected $upload = 'image';
    protected $width = 177;
    protected $height = 236;
    protected $totalPage = 20;

    public function __construct(Cliente $clientes, Request $request)
    {
        $this->model = $clientes;
        $this->request = $request;
    }   

    public function documento($id)
    {
        if (!$data = $this->model->with('documento')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }    

    public function telefone($id)
    {
        if (!$data = $this->model->with('telefone')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }    

    /*
    public function index()
    {
        //
        $data = $this->cliente->all();
        //dd($data);
        return response()->json($data);        
    }


 
    public function store(Request $request)
    {
        //
        $this->validate($request, $this->cliente->rules());

        $dataForm = $request->all();

        /*
        if ($request->hasFile($this->upload) && $request->file($this->upload)->isValid()) {

            $extension = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$extension}";

            $upload = Image::make($dataForm[$this->upload])->resize($this->width, $this->height)->save(storage_path("app/public/{$this->path}/$nameFile", 70));

            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->upload] = $nameFile;
            }
        }
*//*



        $data = $this->cliente->create($dataForm);

        return response()->json($data, 201);

    }

   
    public function show($id)
    {
        //
        if (!$data = $this->cliente->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }

    }


    
    public function update(Request $request, $id)
    {
        //
        if (!$data = $this->cliente->find($id))
            return response()->json(['error' => 'Nada foi encontrado!'], 404);

        $this->validate($request, $this->cliente->rules());

        $dataForm = $request->all();

/*
        if ($request->hasFile($this->upload) && $request->file($this->upload)->isValid()) {
            $arquivo = $this->model->arquivo($id);

            if ($arquivo) {
                Storage::disk('public')->delete("/{$this->path}/$arquivo");
            }

            $extension = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$extension}";

            $upload = Image::make($dataForm[$this->upload])->resize($this->width, $this->height)->save(storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->upload] = $nameFile;
            }
        }
*//*
        $data->update($dataForm);

        return response()->json($data);
    }

   
    public function destroy($id)
    {
        if ($data = $this->cliente->find($id)) {
            $data->delete();
            return response()->json(['success' => 'Deletado com sucesso!']);
        } else {
            return response()->json(['error' => 'Nada foi encontrado!'], 404);
        }
    }
    */
}
