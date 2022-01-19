@extends('layouts.main')

@section('css')
    <style>
        ul {
            width: 100%;
        }

        li {
            margin: 3px;
            text-align: center;
            justify-content: center;
            display: block;
            float: left;
            width: 50px;
            height: 50px;
            border: 2px solid black;
            padding: 5px;
            background-color: white;
            color: black;
            border-radius: 500px 500px 500px 500px;
        }

    </style>
@endsection

@section('title', 'Nova Aposta')

@section('content')
    <input type="hidden" id="jogo_id" name="jogo_id" value="{{ $jogo->id }}">

    <div class="row">
        <div class="col-6">
            <ul id="numeros">
                @for ($i = 1; $i <= $jogo->number_quantity; $i++)
                    <li id="{{ $i }}">{{ $i }}</li>
                @endfor
            </ul>
        </div>

        <div class="col-6">
            <p>Valor: R$<span class="valor_aposta">00,00</span></p>

            <form method="POST" action="{{ route('aposta.store') }}" class="form">
                @csrf
                <input type="hidden" id="concurso_id" name="concurso_id" value="{{ $concurso_id }}">

                <input type="hidden" id="aposta" name="aposta">
                <input type="hidden" id="price_id" name="price_id">

                <button class="btn btn-success disabled" id="finalizar" type="submit">Finalizar Aposta</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //Variaveis para os numeros da aposta
        let numeros = document.querySelectorAll('li');
        let numerosAposta = [];

        //Variávei para a finalização da aposta
        let btn = document.querySelector('#finalizar');
        let valor = document.querySelector('.valor_aposta');
        let maximoNumeros;
        let aposta = document.querySelector('#aposta');
        let price_id = document.querySelector('#price_id');

        //Pegando o id do jogo
        let jogo_id = document.querySelector('#jogo_id');

        //Criando a requisição AJAX
        let req = new XMLHttpRequest();
        let res;
        let url = '/aposta/dados/' + jogo_id.value;

        //Definindo o tipo de retorno da requisição AJAX
        req.responseType = 'json';

        //Pegando a resposta da requisição
        req.onreadystatechange = () => {
            if (req.readyState == 4) {
                res = req.response;

                res.forEach(element => {
                    if (element['maximo']) {
                        maximoNumeros = element['quantidade'];
                    }
                });
            }
        }

        //Abrindo a requisição
        req.open("GET", url);

        //Enviando a requisição
        req.send();

        //Função de verificação dos numeros selecionados
        function verificarAposta(array) {
            for (let i = 0; i < res.length; i++) {
                if (array.length < res[i]['quantidade']) {
                    if (btn.className.indexOf('disabled') === -1) {
                        btn.className += ' disabled'
                    }
                    break
                } else {
                    if (array.length === res[i]['quantidade']) {
                        valor.textContent = res[i]["valor"];
                        aposta.value = array;

                        price_id.value = res[i]['id']

                        if (btn.className.indexOf('disabled') !== -1) {
                            btn.className = btn.className.slice(0, btn.className.indexOf('disabled') - 1)

                        }
                        break
                    }

                }
            }

        }

        //Adicionando evento a cada um dos li que contém os números
        numeros.forEach(element => {
            element.addEventListener('click', () => {
                //Verificando se o número já foi selecionado
                if (element.style.backgroundColor === 'green') {
                    element.style.backgroundColor = 'white'

                    let index = numerosAposta.indexOf(Number(element.id));

                    numerosAposta.splice(index, 1);

                    verificarAposta(numerosAposta);
                } else {
                    if (numerosAposta.length !== maximoNumeros) {
                        //Modificando a cor de fundo dos numeros selecionados
                        element.style.backgroundColor = 'green';

                        //Adicionando o numero selecionado ao array de números da aposta
                        numerosAposta.push(Number(element.id));

                        verificarAposta(numerosAposta);
                    }
                }
            })
        });
    </script>
@endsection
