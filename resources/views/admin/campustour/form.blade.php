<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Campus Tour</h1>
                </div>
                <div class="col-auto">
                    <a class="btn btn-soft-primary" href="{{ route('admin.campustour.index') }}">
                        <i class="bi-plus me-1"></i> Back
                    </a>
                </div>
               
            </div>
            
        </div>
        <div class="card">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (@$campustour)
                    @method('put')
                @endif
            <div class="card-body">
                <h3 class="mb-3 card-title">{{ @$campustour ? 'Edit' : 'Create' }} Campus Tour</h3>
                <div class="mb-3">
                    <label class="form-label fw-bold fs-5" for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', @$campustour->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="inputkan title" autofocus>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label fw-bold fs-5">Choose file input</label>
                  <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="mb-3">
                    <img src="#" id="preview-image" style="display:none; width:200px;">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fs-5 fw-bold">Description</label>
                    <textarea class="form-control" name="description"  id="description" placeholder="Description" rows="10">{{ @$campustour->description }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-soft-success">
                    <i class="bi bi-save"></i>
                    Save
                </button>
            </div>
        </form>
        </div>
    </div>
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
</x-app-layout>

