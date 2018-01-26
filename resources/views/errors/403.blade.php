@extends("layouts.error")

@section("html-class", 'transition-navbar-scroll top-navbar-xlarge')

@section("title", 'Error 403')

@section("content")
    <div class="container">
        <div class="page-section">
            <div class="login-form-300w">
                <div class="panel panel-default text-center paper-shadow text-center">
                    <div class="panel-body">
                        <h1 class="text-display-4">403</h1>
                        <p>Not Allowed</p>
                        <div class="padding-v-15">
                            <a href="/" class="btn btn-primary">Home <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection