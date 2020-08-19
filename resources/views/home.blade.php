@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($people == 0 || $planets == 0 || $species == 0)
                            <form method="POST" action="{{ route('species.index') }}">
                                @csrf
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Species') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if($species != 0)
                                <form method="POST" action="{{ route('planets.index') }}">
                                    @csrf
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update Planets') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            @if($planets != 0)
                                <form method="POST" action="{{ route('people.index') }}">
                                    @csrf
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update People') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @endif

                        @if($people != 0)
                            <ul>
                                <li><a href="{{ route('layouts.overview.index') }}">Overzicht</a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
