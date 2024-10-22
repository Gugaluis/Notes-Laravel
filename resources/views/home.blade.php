@extends('layouts/main_layout')
@section('content')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <!-- Nenhuma nota disponivel -->
        @if (count ($notes) == 0)
        
            <div class="row mt-5">
                <div class="col text-center">
                    <p class="display-6 mb-5 text-secondary opacity-50">Você não tem notas disponiveis</p>
                    <a href="{{ route ('new') }}" class="btn btn-secondary btn-lg p-3 px-5">
                        <i class="fa-regular fa-pen-to-square me-3"></i>Criar sua primeira nota
                    </a>
                </div>
            </div>

        @else

            <!-- Notas Disponiveis -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('new')}}" class="btn btn-secondary px-3">
                    <i class="fa-regular fa-pen-to-square me-2"></i>Nova nota
                </a>
            </div>

            @foreach ($notes as $note)

            @include('note')

            @endforeach

        @endif

        </div>
    </div>
</div>


@endsection