<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Leader</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-soft-primary" href="{{ route('admin.leader.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <div class="card">
            <div class="card-body">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (@$leader)
                    @method('put')
                @endif
                    <h3 class="mb-3 card-title">{{ @$leader ? 'Edit' : 'Create' }} Leader</h3>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold fs-5">Name Leader</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="inputkan name" value="{{ old('name', @$leader->name) }}" >
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                            
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold fs-5">Position Leader</label>
                        <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old ('position', @$leader->position) }}"  placeholder="inputkan position">
                        @error('position')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                       <div class="mb-3">
                        <label for="image" class="form-label fw-bold fs-5">Choose Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        </div>  
                        <div class="mb-3">
                            <img src="#" id="preview-image" style="display:none; width:200px;">
                        </div>
                                        <!-- Card -->
                </div>
                <div class="card-footer">
                    <button type="sumbit" class="btn btn-success">
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