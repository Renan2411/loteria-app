@extends('layouts.main')

@section('title', 'Concursos')

@section('content')

    <a href="{{ route('concurso.create', $id) }}" class="btn btn-success">
        Criar Concurso
    </a>

    <section class="mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="row">Numero</th>
                    <th scope="row">Sorteio</th>
                    <th scope="row">Numeros Sorteados</th>
                    <th scope="row">Ações</th>
                </tr>
            </thead>

            <tbody>
                @if (isset($concursos))
                    @foreach ($concursos as $item)
                        <tr>
                            <td>{{ $item->codigo }}</td>
                            <td>
                                @if ($item->sorteado)
                                    Finalizado
                                @else
                                    Em andamento
                                @endif
                            </td>
                            <td>
                                @if ($item->sorteado)
                                    [
                                    @foreach ($item->numero->numeros as $num)
                                        {{ $num }}
                                        @if ($loop->index != 5)
                                            -
                                        @endif
                                    @endforeach
                                    ]
                                @else
                                    Em andamento
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('sortear', $item->id) }}"
                                    class="btn btn-info @if ($item->sorteado)
                                    disabled
                                @endif">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>

                                <a href="{{ route('aposta', $item->id) }}"
                                    class="btn btn-success ">
                                    <i class="bi bi-coin"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                @else
                    Sem concursos disponíveis
                @endif
            </tbody>




        </table>
    </section>

@endsection
