@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $phone->name }}</div>
                    <div class="panel-body">
                        {{ $phone->description }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Accessories</div>

                        <div class="panel-body">
                        @if($phone->accessories->isNotEmpty())
                            @foreach($phone->accessories as $accessory)
                                @include('partials._show-accessories')
                            @endforeach
                        @else
                            <h4>There are no accessories for this phone in our store</h4>
                        @endif
                        </div>

                </div>
            </div>
        </div>
    </div>

@endsection