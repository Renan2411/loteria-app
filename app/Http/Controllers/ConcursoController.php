<?php

namespace App\Http\Controllers;

use App\Models\Concurso;
use App\Services\ConcursoService;
use DateTime;
use Illuminate\Http\Request;

class ConcursoController extends Controller
{
    private $concursoService;
    private $concursoModel;

    public function __construct(Concurso $concursoModel, ConcursoService $concursoService)
    {
        $this->concursoModel = $concursoModel;
        $this->concursoService = $concursoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $concursos = $this->concursoModel->where('jogo_id', $id)->orderby('created_at', 'desc')->get();

        return view('pages.concursos.index', [
            'id' => $id,
            'concursos' => $concursos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

       $data = $this->concursoService->create($id);

        return redirect()->back()->with($data['class'], $data['mensagem']);
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
     * @param  \App\Models\Concurso  $concurso
     * @return \Illuminate\Http\Response
     */
    public function show(Concurso $concurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Concurso  $concurso
     * @return \Illuminate\Http\Response
     */
    public function edit(Concurso $concurso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Concurso  $concurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concurso $concurso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Concurso  $concurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concurso $concurso)
    {
        //
    }
}
