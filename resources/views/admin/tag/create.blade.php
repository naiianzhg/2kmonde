@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Tag
                    <small>>> Add a tag</small>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Adding tag form</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.errors')

                        <form action="/admin/tag" role="form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label for="tag" class="col-md-3 col-form-label">Tag</label>
                                <div class="col-md-3">
                                    <input type="text" name="tag" id="tag" value="{{ $tag }}" class="form-control" autofocus>
                                </div>
                            </div>

                            @include('admin.tag._form')

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="fa fa-save"></i> Save new tag
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
