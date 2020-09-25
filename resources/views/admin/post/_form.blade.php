<div class="row">
    <div class="col-md-7">
        <div class="form-group row">
            <label for="title" class="col-md-2 col-form-label">
                Title
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" id="title" autofocus value="{{ $title }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                Subtitle
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="page_image" class="col-md-3 col-form-label">
                Thumbnail
            </label>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="page_image" id="page_image" onchange="handle_image_change()" value="{{ $page_image }}">
                    </div>
                    <script>
                        function handle_image_change() {
                            $("#page-image-preview").attr("src", function () {
                                let value = $("#page_image").val();
                                if (!value) {
                                    value = {!! json_encode(config('blog.page_image')) !!};
                                    if (value == null) {
                                        value = '';
                                    }
                                }
                                if (value.substr(0, 4) != 'http' && value.substr(0, 1) != '/') {
                                    value = {!! json_encode(config('blog.uploads.webpath')) !!} + '/' + value;
                                }
                                return value;
                            });
                        }
                    </script>
                    <div class="visible-sm space-10"></div>
                    <div class="col-md-3 text-right">
                        <img src="{{ page_image($page_image) }}" class="img-thumbnail" id="page-image-preview" style="max-height: 100px">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label">
                Content
            </label>
            <div class="col-md-10">
                <textarea name="content" id="content" rows="14" class="form-control">{{ $content }}</textarea>
            </div>
        </div>
    </div>


    <div class="col-md-5">
        <div class="form-group row">
            <label for="publish_date" class="col-md-4 col-form-label">
                Publish date
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="publish_date" id="publish_date" value="{{ $publish_date }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="publish_time" class="col-md-4 col-form-label">
                Publish time
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="publish_time" id="publish_time" value="{{ $publish_time }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <div class="checkbox">
                    <label>
                        <input {{ checked($is_draft) }} type="checkbox" name="is_draft">
                        Draft?
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="tags" class="col-md-4 col-form-label">
                Tags
            </label>
            <div class="col-md-8">
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($allTags as $tag)
                        <option @if(in_array($tag, $tags)) selected @endif value="{{ $tag }}">{{ $tag }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="layout" class="col-md-4 col-form-label">
                Layout
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="meta_description" class="col-md-4 col-form-label">
                Description
            </label>
            <div class="col-md-8">
                <textarea class="form-control" name="meta_description" id="meta_description" rows="6">{{ $meta_description }}</textarea>
            </div>
        </div>
    </div>
</div>
