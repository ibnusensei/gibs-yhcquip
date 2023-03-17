<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row aligns-items-center">
                <div class="col">
                    <h1 class="page-header-title">About</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.about.index') }}" class="btn btn-soft-primary">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (@$about)
                        @method('put')
                    @endif
                <h2 class="mb-3 card-title">{{ @$about ? 'Edit' : 'Create' }} About</h2>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold fs-4">Title About</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" autofocus placeholder="input about name" value="{{ old('title', @$about->title) }}">
                        @error('title')
                        
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold fs-5">Choose Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" required>
                    </div>
                   
                    <div class="mb-3">
                        <img src="#" id="preview-image" style="display:none; width:200px;">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold fs-4">Description About</label>
                        <textarea name="description" id="description"  rows="10" class="form-control">{{ @$about->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="sumbit" class="btn btn-success">
                        <i class="bi-save"></i>
                        Save</button>
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

