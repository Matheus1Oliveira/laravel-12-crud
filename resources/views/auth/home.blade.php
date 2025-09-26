@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Home</h4>
                </div>
                <div class="card-body text-center">
                    
                    <div class="alert alert-success">
                        @if ($message = Session::get('success'))
                            {{ $message }}
                        @else
                            Você está logado com sucesso!
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
