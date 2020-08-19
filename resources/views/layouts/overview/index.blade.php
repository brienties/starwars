@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Overzicht') }}</div>

                  {{dd($overview)}}
                  <pre>{{ print_r($overview) }}</pre>
                </div>

                @foreach($overview as $item)

                    {{$item->name}}

                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection
