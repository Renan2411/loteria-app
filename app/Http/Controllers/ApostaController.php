<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use App\Models\Concurso;
use App\Models\Price;
use App\Services\ApostaService;
use Illuminate\Http\Request;

class ApostaController extends Controller
{
    private $concursoModel;
    private $priceModel;
    private $apostaModel;
    private $apostaService;

    public function __construct(Concurso $concursoModel, Price $priceModel, Aposta $apostaModel, ApostaService $apostaService)
    {
        $this->concursoModel = $concursoModel;
        $this->priceModel = $priceModel;
        $this->apostaModel = $apostaModel;
        $this->apostaService = $apostaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($concurso_id)
    {
        $apostas = $this->apostaModel->where('concurso_id', $concurso_id)->get();
        $concurso = $this->concursoModel->find($concurso_id);

        // dd($concurso->jogo->prices);

        if ($concurso->sorteado) {
            $data = $this->apostaService->conferirAposta($concurso_id);
            return view('pages.apostas.index', [
                'concurso_id' => $concurso_id,
                'apostas' => $apostas,
                'concurso' => $concurso
            ])->with($data['class'], $data['mensagem']);
        }

        // dd($this->apostaModel->all());
        return view('pages.apostas.index', [
            'concurso_id' => $concurso_id,
            'apostas' => $apostas,
            'concurso' => $concurso
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($concurso_id)
    {
        $data = $this->apostaService->create($concurso_id);

        if (isset($data['class'])) {
            return redirect()->back()->with($data['class'], $data['mensagem']);
        }

        return view('pages.apostas.create', [
            'jogo' => $data['jogo'],
            'concurso_id' => $concurso_id
        ]);
    }

    public function dados($jogo_id)
    {
        $prices = $this->priceModel->where('jogo_id', $jogo_id)->get();

        return $prices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->aposta == 'automatico') {
            $data = $this->apostaService->storeAutomatico($request->all());
        } else {
            $data = $this->apostaService->store($request->all());
        }


        return redirect()->route('aposta', $request->concurso_id)->with($data['class'], $data['mensagem']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function show(Aposta $aposta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function edit(Aposta $aposta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aposta $aposta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aposta $aposta)
    {
        //
    }
}
