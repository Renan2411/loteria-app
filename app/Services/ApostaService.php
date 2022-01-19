<?php

namespace App\Services;

use App\Models\Aposta;
use App\Models\Concurso;
use App\Models\Price;

class ApostaService
{
    private $concursoModel;
    private $apostaModel;
    private $priceModel;

    public function __construct(Concurso $concursoModel, Aposta $apostaModel, Price $priceModel)
    {
        $this->concursoModel = $concursoModel;
        $this->apostaModel = $apostaModel;
        $this->priceModel = $priceModel;
    }

    public function create($concurso_id)
    {
        try {
            $concurso = $this->concursoModel->find($concurso_id);

            if ($concurso->sorteado) {
                return $data = [
                    'class' => 'danger',
                    'mensagem' => 'Concurso Finalizado'
                ];
            } else {
                return $data = [
                    'jogo' => $concurso->jogo,
                ];
            }
        } catch (\Throwable $th) {
            return $data = [
                'class' => 'danger',
                'mensagem' => 'Houve um problema interno, tente novamente'
            ];
        }
    }

    public function store($attributes)
    {
        try {
            $concurso = $this->concursoModel->find($attributes['concurso_id']);

            if ($concurso->sorteado) {
                return $data = [
                    'class' => 'danger',
                    'mensgem' => 'O concurso foi finalizado!!!'
                ];
            }


            $codigo = count($this->apostaModel->where('concurso_id', $attributes['concurso_id'])->get()) + 1;

            $aposta = explode(",", $attributes['aposta']);

            for ($i = 0; $i < count($aposta); $i++) {
                $aposta[$i] = intval($aposta[$i]);
            }

            $dados = [
                'concurso_id' => $attributes['concurso_id'],
                'numeros' => $aposta,
                'price_id' => $attributes['price_id'],
                'codigo' => $codigo
            ];

            $created = $this->apostaModel->create($dados);

            if ($created) {
                return $data = [
                    'class' => 'success',
                    'mensagem' => 'Aposta criada com sucesso!!!'
                ];
            } else {
                return $data = [
                    'class' => 'danger',
                    'mensagem' => 'Houve um erro ao criar a aposta!!!'
                ];
            }
        } catch (\Throwable $th) {
            return $data = [
                'class' => 'danger',
                'mensagem' => 'Houve um erro ao criar a aposta!!!'
            ];
        }
    }

    public function storeAutomatico($attributes)
    {
        try {

            $concurso = $this->concursoModel->find($attributes['concurso_id']);

            if ($concurso->sorteado) {
                return $data = [
                    'class' => 'danger',
                    'mensagem' => 'O concurso foi finalizado!!!'
                ];
            }

            $price = $this->priceModel->find($attributes['price_id']);
            $quantidade_numeros = $price->quantidade;
            $maximo_numeros = $price->jogo->number_quantity;
            $numeros = [];
            $codigo = count($this->apostaModel->where('concurso_id', $attributes['concurso_id'])->get()) + 1;

            for ($i = 1; $i <= $quantidade_numeros; $i++) {
                $num = rand(1, $maximo_numeros);

                if (!in_array($num, $numeros)) {
                    array_push($numeros, $num);
                } else {
                    $i--;
                }
            }


            $dados = [
                'price_id' => $attributes['price_id'],
                'concurso_id' => $attributes['concurso_id'],
                'codigo' => $codigo,
                'numeros' => $numeros
            ];

            $created = $this->apostaModel->create($dados);

            if ($created) {
                return $data = [
                    'class' => 'success',
                    'mensagem' => 'Aposta criada com sucesso!!!'
                ];
            } else {
                return $data = [
                    'class' => 'danger',
                    'mensagem' => 'Houve um erro ao criar a aposta!!!'
                ];
            }
        } catch (\Throwable $th) {
            return $data = [
                'class' => 'danger',
                'mensagem' => 'Houve um erro ao criar a aposta!!!'
            ];
        }
    }

    public function conferirAposta($concurso_id)
    {
        try {
            $apostas = $this->apostaModel->where('concurso_id', $concurso_id)->get();

            foreach ($apostas as $item) {

                $pontos = 0;

                foreach ($item->numeros as $num) {
                    if (in_array($num, $item->concurso->numero->numeros)) {

                        $pontos++;
                    }
                }

                $item->pontos = $pontos;
                $item->premiado = false;

                if ($pontos >= $item->concurso->jogo->minimo) {

                    $item->premiado = true;
                }

                $item->save();
            }

            return $data = [
                'class' => 'success',
                'mensagem' => 'Apostas Conferidas com Sucesso'
            ];
        } catch (\Throwable $th) {
            return $data = [
                'class' => 'danger',
                'mensgem' => 'Houve um problema ao conferir apostas'
            ];
        }
    }
}
