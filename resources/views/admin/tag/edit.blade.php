@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Tag
                    <small>>> Edit a tag</small>
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
                        @include('admin.partials.success')

                        <form action="/admin/tag/{{ $id }}" role="form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $id }}">

                            <div class="form-group row">
                                <label for="tag" class="col-md-3 col-form-label">Tag</label>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext">{{ $tag }}</p>
                                </div>
                            </div>

                            @include('admin.tag._form')

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="fa fa-save"></i> Save edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
                                        <i class="fa fa-times-circle"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation --}}
    <div class="modal fade" id="modal-delete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Please confirm</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i> Are you sure to delete this tag?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="/admin/tag/{{ $id }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
