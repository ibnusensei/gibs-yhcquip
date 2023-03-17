<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
    <div class="page-header">
    <div class="row align-items-center">
      <div class="col-sm mb-2 mb-sm-0">
        <h2 class="page-header-title">Staff</h2>
      </div>
  
      <div class="col-sm-auto">
        <a class="btn btn-soft-primary btn-sm" href="{{ route('admin.staff.index') }}">
          <i class="bi-chevron-left me-1"></i> Back
        </a>
      </div>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="card">
      <form action="{{ $url }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (@$staff)
            @method('put')
        @endif
    <div class="card-body">
        <h3 class="card-title">{{ @$staff ? 'Edit' : 'Create' }} Staff</h3>
        <div class="mb-3 mt-2">
            <label class="form-label fw-bold fs-5 mt-3" for="name">Name Staff</label>
            <input type="text" id="name" name="name" value="{{ old('name', @$staff->name)  }}" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name Staff" autofocus>
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold fs-5" for="position">Position Staff</label>
            <input type="text" id="position" name="position" value="{{ old('position', @$staff->position)  }}" class="form-control @error('position') is-invalid @enderror" placeholder="Input Position Staff">
            @error('position')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold fs-5" for="image">Choose file input</label>
            <input type="file" id="image" name="image"  class="form-control">
          </div>
          <div class="mb-3">
            <img src="#" id="preview-image" style="display:none; width:200px;">
        </div>
          
    </div>
    <div class="card-footer">
        <button type="sumbit" class="btn btn-sm btn-soft-success">
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