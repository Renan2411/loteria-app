@extends('layouts.main')

@section('title', 'Apostas')

@section('content')
    <h1>Apostas</h1>

    <a href="{{ route('concursos', $concurso->jogo->id) }}" class="btn btn-success">Voltar</a>

    @if ($concurso->sorteado === false)
        <a href="{{ route('aposta.create', $concurso_id) }}" class="btn btn-success">Nova Aposta</a>

        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#apostaAutomática">Aposta Automática</button>
    @endif


    <section class="mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="row">Código</th>
                    <th scope="row">Numeros</th>
                    <th scope="row">Valor</th>
                    <th scope="row">Situação</th>
                    <th scope="row">Pontos</th>
                    <th scope="row">Ações</th>
                </tr>
            </thead>

            <tbody>
                @if (isset($apostas))
                    @foreach ($apostas as $item)
                        <tr>
                            <td>{{ $item->codigo }}</td>
                            <td>
                                [
                                @foreach ($item->numeros as $num)
                                    {{ $num }}
                                    @if ($loop->index != count($item->numeros) - 1)
                                        ,
                                    @endif
                                @endforeach
                                ]
                            </td>
                            <td>R${{ $item->price->valor }}</td>
                            <td>
                                @if ($item->concurso->sorteado === false)
                                    Concurso em Andamento
                                @else
                                    @if ($item->premiado)
                                        Premiado
                                    @else
                                        Não Premiado
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($item->concurso->sorteado)
                                    {{ $item->pontos }}
                                @endif
                            </td>
                            <td>Deletar</td>
                        </tr>
                    @endforeach
                @else
                    Sem concursos disponíveis
                @endif
            </tbody>

        </table>
    </section>


    {{-- MODAL --}}
    <div class="modal fade" id="apostaAutomática" tabindex="-1" aria-labelledby="apostaModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="apostaModal">Aposta Automática</h3>

                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" type="button"></button>
                </div>

                <div class="modal-body">
                    Selecione a quantidade de números da aposta
                </div>

                <div class="modal-footer">
                    <div class="mx-auto">
                        @foreach ($concurso->jogo->prices as $item)

                            <form action="{{ route('aposta.store') }}" class="d-inline" method="POST">
                                @csrf
                                <input type="hidden" name="price_id" value="{{ $item->id }}">
                                <input type="hidden" name="concurso_id" value="{{ $concurso_id }}">
                                <input type="hidden" name="aposta" value="automatico">

                                <button class="btn btn-info" type="submit">{{ $item->quantidade }}</button>
                            </form>

                            {{-- <a href="" class="btn btn-info">{{$item->quantidade}}</a> --}}
                        @endforeach

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
