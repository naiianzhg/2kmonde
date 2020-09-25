@extends('admin.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pickadate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/selectize.default.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>Post
                    <small>>> Create new post</small>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Creating post form</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.errors')

                        <form action="{{ route('post.store') }}" role="form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('admin.post._form')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Save new post
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/pickadate.min.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script>
        $(function () {
            $("#publish_date").pickadate({
                format: "yyyy-mm-dd"
            });
            $("#publish_time").pickatime({
                format: "h:i A",
                interval: 1
            });
            $("#tags").selectize({
                create: false
            });
        });
    </script>
@stop
