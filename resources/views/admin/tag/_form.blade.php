<div class="form-group row">
    <label for="title" class="col-md-3 col-form-label">Title</label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
    </div>
</div>

<div class="form-group row">
    <label for="subtitle" class="col-md-3 col-form-label">Subtitle</label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
    </div>
</div>

<div class="form-group row">
    <label for="meta_description" class="col-md-3 col-form-label">Description</label>
    <div class="col-md-8">
        <textarea name="meta_description" id="meta_description" rows="3" class="form-control">{{ $meta_description }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="page_image" class="col-md-3 col-form-label">Image</label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="page_image" id="page_image" value="{{ $page_image }}">
    </div>
</div>

<div class="form-group row">
    <label for="layout" class="col-md-3 col-form-label">Layout</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}">
    </div>
</div>

<div class="form-group row">
    <label for="reverse_direction" class="col-md-3 col-form-label">Order</label>
    <div class="col-md-7">
        <label class="radio-inline">
            <input type="radio" name="reverse_direction" id="reverse_direction"
                @if (! $reverse_direction)
                    checked="checked"
                @endif
                value="0">
            Asc
        </label>
        <label class="radio-inline">
            <input type="radio" name="reverse_direction" id="reverse_direction"
                   @if ($reverse_direction)
                   checked="checked"
                   @endif
                   value="1">
            Desc
        </label>
    </div>
</div>
