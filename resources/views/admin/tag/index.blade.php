@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Tag
                    <small>>> All</small>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/tag/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> Add a tag
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Title</th>
                        <th class="hidden-sm">Subtitle</th>
                        <th class="hidden-md">Image</th>
                        <th class="hidden-md">Description</th>
                        <th class="hidden-md">Layout</th>
                        <th class="hidden-sm">Order</th>
                        <th data-sortable="false">Operate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->tag }}</td>
                            <td>{{ $tag->title }}</td>
                            <td class="hidden-sm">{{ $tag->subtitle }}</td>
                            <td class="hidden-md">{{ $tag->page_image }}</td>
                            <td class="hidden-md">{{ $tag->meta_description }}</td>
                            <td class="hidden-md">{{ $tag->layout }}</td>
                            <td class="hidden-sm">
                                @if($tag->reverse_direction)
                                    Desc
                                @else
                                    Asc
                                @endif
                            </td>
                            <td>
                                <a href="/admin/tag/{{ $tag->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#tags-table").DataTable({});
        });
    </script>
@stop
