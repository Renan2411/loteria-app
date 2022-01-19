<?php

namespace App\Services;

use App\Models\Concurso;
use App\Models\Numeros;

class NumerosService
{

    private $numerosModel;
    private $concursoModel;

    public function __construct(Numeros $numerosModel, Concurso $concursoModel)
    {
        $this->numerosModel = $numerosModel;
        $this->concursoModel = $concursoModel;
    }

    public function sortear($concurso_id)
    {
        try {
            $numerosSorteados = [];
            $concurso = $this->concursoModel->find($concurso_id);

            if (!$concurso->sorteado) {
                //Pegando o intervalo de números que podem ser sorteados
                $maximoNumeros = $concurso->jogo->number_quantity;

                //Pegando a quantidade de numeros que pode ser sorteados
                $quantidade = $concurso->jogo->maximo;

                for ($i = 0; $i < $quantidade; $i++) {
                    $numeroAleatorio = rand(1, $maximoNumeros);

                    if (!in_array($numeroAleatorio, $numerosSorteados)) {
                        array_push($numerosSorteados, $numeroAleatorio);
                    } else {
                        $i--;
                    }
                }

                $dados = [
                    'numeros' => $numerosSorteados,
                    'concurso_id' => $concurso_id
                ];

                $this->numerosModel->create($dados);

                $concurso->update([
                    'sorteado' => true
                ]);
                $concurso->save();

                return $data = [
                    'class' => 'success',
                    'mensagem' => 'Sorteio realizado com sucesso'
                ];
            }else{
                return $data = [
                    'class' => "danger",
                    'mensagem' => 'O sorteio já foi realizado'
                ];
            }
        } catch (\Throwable $th) {
            return $data = [
                'class' => "danger",
                'mensagem' => 'Houve um erro ao realizar sorteio'
            ];
        }
    }
}
