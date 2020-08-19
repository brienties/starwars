@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Overzicht') }}</div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" colspan="4">People</th>
                            <th scope="col" colspan="4">Planets</th>
                        </tr>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Birth Year</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Skin Color</th>
                            <th scope="col">Homeworld</th>
                            <th scope="col">Climate</th>
                            <th scope="col">Terrain</th>
                            <th scope="col">Diameter</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($overview as $item)
                            <tr>
                                <th>{{$item->name}}</th>
                                <th>{{$item->birth_year}}</th>
                                <th>{{$item->gender}}</th>
                                <th>{{$item->skin_color}}</th>
                                <td>{{$item->homeworlds->name}}</td>
                                <td>{{$item->homeworlds->climate}}</td>
                                <td>{{$item->homeworlds->terrain}}</td>
                                <td>{{$item->homeworlds->diameter}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
