<x-app-layout>
    @push('styles')
        <style>
            .img-custom {
                height: 200px !important;
                border-radius: 0.25rem
                    /* 4px */
                ;
                overflow: hidden;
            }

            .img-custom>img {
                background-size: cover;
                height: auto;
                width: 100%;
            }
        </style>
    @endpush

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row aligns-items-center">
                <div class="col">
                    <h1 class="page-header-title">About</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.about.index') }}" class="btn btn-primary">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Detail : {{ $about->title }}</h4>
                <!-- Card -->
<div class="card mb-3" style="max-width: 100%;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img class="img-fluid" src="{{ $about->getFirstMediaUrl('image', 'thumb') }}" alt="Card image cap">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $about->title }}</h5>
          <p class="card-text">{{ $about->description }}</p>
          
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
            </div>
        </div>
    </div>
    @include('scripts.delete')
</x-app-layout>