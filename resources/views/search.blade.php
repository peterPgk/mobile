@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search results</div>

                <div class="panel-body">
                    @if($phones)
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Found Phones</h4>
                            </div>
                            <div class="col-xs-12">
                                @foreach($phones as $phone)
                                    @include('partials._show-phones')
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($accessories)
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Found Accessories</h4>
                            </div>
                            <div class="col-xs-12">
                                @foreach($accessories as $accessory)
                                    @include('partials._show-accessories')
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
