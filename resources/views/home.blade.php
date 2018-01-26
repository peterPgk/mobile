@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Phones magazine</div>

                <div class="panel-body">
                    <form class="form-inline" method="get" action="{{ route('search') }}">
                        <label class="sr-only" for="query">Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2 @if($errors && $errors->has('query')) is-invalid @endif"
                               id="query" name="query" placeholder="Search for phone">

                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        @if (isset($errors))
                            @foreach($errors->all() as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
