<?php

namespace App\Services;

use App\Models\Concurso;

class ConcursoService{

    private $concursoModel;

    public function __construct(Concurso $concursoModel)
    {
        $this->concursoModel = $concursoModel;
    }

    public function create($id){

        $concursoEmAndamento = count($this->concursoModel->where('jogo_id', $id)->where('sorteado', false)->get());

        if($concursoEmAndamento != 0){
            return $data = [
                'class' => 'danger',
                'mensagem' => 'Há outros concursos em andamento'
            ];
        }

        $codigo = count($this->concursoModel->where('jogo_id', $id)->get()) + 1;

        $this->concursoModel->create([
            'jogo_id' => $id,
            'codigo' => $codigo
        ]);

        return $data = [
            'class' => 'success',
            'mensagem' => 'Concurso Criado com Sucesso'
        ];

    }

}