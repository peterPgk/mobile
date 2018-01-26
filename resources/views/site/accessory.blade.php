@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $accessory->name }}</div>
                    <div class="panel-body">
                        {{ $accessory->description }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Phones that fit</div>

                    @if($accessory->phones->isNotEmpty())
                    <div class="panel-body">
                        @foreach($accessory->phones as $phone)
                            @include('partials._show-phones')
                        @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection