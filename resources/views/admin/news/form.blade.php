<x-app-layout>
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
                            <select name="category" id="" class="form-select">
                                <option selected>Category</option>
                                <option {{ @$news['category'] && $news['category'] == 'school' ? 'selected' : '' }}
                                    value="school">School</option>
                                <option {{ @$news['category'] && $news['category'] == 'tecno' ? 'selected' : '' }}
                                    value="tecno">Tecno</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="images" name="images" class="form-control"
                                onchange="previewImage()">
                        </div>
                        <div class="form-group mb-3">
                            <img src="" id="image-preview" class="img-thumbnail"
                                style="display:none; width:240px">
                        </div>
                        @if (@$news)
                            <img id="old-img" src="{{ @$news->getFirstMediaUrl('news', 'thumb') }}" alt=""
                                class="img-thumbnail" width="240px">
                        @endif


                        <div class="mb-3">
                            <textarea id="konten" class="form-control" name="content" rows="10" cols="50">{!! @$news->content !!}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
        <script>
            var konten = document.getElementById("konten");
            CKEDITOR.replace(konten, {
                language: 'en-gb'
            });
            CKEDITOR.config.allowedContent = true;
        </script>

        <script>
            function previewImage() {
                var preview = document.querySelector('#image-preview');
                var file = document.querySelector('#images').files[0];
                var old = document.querySelector('#old-img');
                var reader = new FileReader();

                reader.onloadend = function() {
                    if (old) {
                        old.hidden = true;
                    }
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "";
                    preview.style.display = 'none';
                }
            }
        </script>
    @endpush
    <!-- End Content -->
</x-app-layout>
