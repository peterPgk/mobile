@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{!! $title or '' !!}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! form($form) !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@stop
