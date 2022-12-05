<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Estoque\Categoria;
use App\Models\Estoque\Cor;
use App\Models\Estoque\Estoque_aux;
use App\Models\Estoque\Fornecedor;
use App\Models\Estoque\Marca;
use App\Models\Estoque\Tamanho;
use App\Models\Estoque\Unidade;
use App\Models\EstoqueAlimentar;
use Illuminate\Http\Request;

class EstoqueAlimentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categoria::all();
        $cor = Cor::all();
        $tamanho = Tamanho::all();
        $unidade = Unidade::all();
        $fornecedor = Fornecedor::all();

        return view('admin.estoque.alimento.register',[
            'categoria'     =>  $categoria,
            'cor'           =>  $cor,
            'tamanho'       =>  $tamanho,
            'unidade'       =>  $unidade,
            'fornecedor'    =>  $fornecedor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstoqueAlimentar  $estoqueAlimentar
     * @return \Illuminate\Http\Response
     */
    public function show(EstoqueAlimentar $estoqueAlimentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstoqueAlimentar  $estoqueAlimentar
     * @return \Illuminate\Http\Response
     */
    public function edit(EstoqueAlimentar $estoqueAlimentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstoqueAlimentar  $estoqueAlimentar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstoqueAlimentar $estoqueAlimentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstoqueAlimentar  $estoqueAlimentar
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstoqueAlimentar $estoqueAlimentar)
    {
        //
    }

    public function cadastrar(Request $request){

        if(count(EstoqueAlimentar::where('codigo','=',$request->codigo)->get())>0){
            $estoque = EstoqueAlimentar::where('codigo','=',$request->codigo)->first();
        }else{
            $estoque = new EstoqueAlimentar();
            $estoque->codigo = $request->codigo;
        }
        $estoque->categoria = $request->categoria;
        $estoque->nome      = strtoupper($request->nome);
        $estoque->descricao = strtoupper($request->descricao);
        $estoque->estoque   = $request->estoque;
        $estoque->unidade   = $request->unidade;
        $estoque->lucro     = str_replace("%","",$request->lucro);
        $estoque->fornecedor= $request->fornecedor;
        $estoque->preco_custo =  str_replace([".",","],["","."],$request->preco_custo);
        $estoque->preco     =  str_replace([".",","],["","."], $request->preco);
        $estoque->estoqueMin = '0';
        $estoque->estoqueMax = '0';


        try{
            $estoque->save();

            return response()->json([
                'success' => "true",
                'message' => 'estoque atualizado com sucesso'
            ]);
        }catch (QueryException  $e){
            $error_code = $e->errorInfo;
            return response()->json([
                'success' => 'false',
                'message' => 'erro no banco de dados, codigo: '.$error_code[2]
            ]);
        }



    }
    public function lista(){
//        $estoque =   DB::table('estoque_alimentars')::all();
//        ,['estoque'=>$estoque]
        return view('admin.estoque.alimento.todos');
    }
}
