<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Article</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div>
            <h4 class="mb-4 card-title">{{ @$article ? 'Edit' : 'Create' }} Article</h4>
            <div class="card">
                <div class="card-body shadow-lg">

                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$article)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of Article" value="{{ @$article->title }}">
                        </div>

                        {{--  <div class="mb-4">
                            <label class="form-label" for="image">Upload Image</label>
                            <input type="file" id="image" class="form-control" name="image">
                        </div>

                        <div class="mb-4">
                          <img src="#" id="preview-image" alt="image" class="d-none" style="max-width: 200px">
                        </div>  --}}

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold fs-5">Choose Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <img src="#" id="preview-image" style="display:none; width:200px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="description">Description</label>
                                <textarea id="editor" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$article->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="author">Author</label>
                            <input type="text" id="author" class="form-control" name="author"
                                placeholder="Author of Article" value="{{ @$article->author }}">
                        </div>

                        {{--  <div class="mb-4">
                            <label class="form-label" for="category">Category</label>
                            <select class="form-select" aria-label="Select by Category">
                                <option selected>Select by Category</option>
                                <option value="1">Technology</option>
                                <option value="2">Education</option>
                                <option value="3">Social</option>
                                <option value="4">Sports</option>
                                <option value="5">Health</option>
                            </select>
                        </div>  --}}


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->



    <script>
        // Mendeteksi perubahan pada input file dan menampilkan preview gambar
        document.getElementById("image").addEventListener("change", function(event) {
            // Mendapatkan file yang dipilih
            const file = event.target.files[0];

            // Membuat FileReader object
            const reader = new FileReader();

            // Setelah file terbaca, tampilkan preview gambar
            reader.onload = function(e) {
                document.getElementById("preview-image").src = e.target.result;
                document.getElementById("preview-image").style.display = "block";
            }

            // Membaca file sebagai URL
            reader.readAsDataURL(file);
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

</x-app-layout>
