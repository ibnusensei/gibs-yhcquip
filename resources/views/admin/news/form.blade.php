<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('/dropify/dist/css/dropify.min.css') }}">
        <style>
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }

            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
        </style>
    @endpush
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">News</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.news.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 card-title">{{ @$news ? 'Edit' : 'Create' }} News</h4>
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$news)
                            @method('PATCH')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of News" value="{{ @$news->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="news_category_id" id="" class="form-select">
                                <option selected>Category</option>
                                @foreach ($category as $item)
                                    <option
                                        {{ @$news['news_category_id'] && $news['news_category_id'] == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-4">
                            <input type="file" class="dropify mb-3"  name="images" data-max-file-size="1M"
                                @if (@$news) data-default-file="{{ @$news->getFirstMediaUrl('news', 'thumb') }}" @endif />
                        </div>

                        <div class="mb-3">
                            <textarea id="editor" class="form-control" name="content" rows="10" cols="50">{!! @$news->content !!}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script src="{{ asset('dropify/dist/js/dropify.min.js') }}"></script>
        <script src="{{ asset('/vendor/ckeditor5/ckeditor.js') }}"></script>
        <script>
            $('.dropify').dropify();
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>

    @endpush
    <!-- End Content -->
</x-app-layout>
