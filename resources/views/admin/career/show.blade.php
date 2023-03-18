<x-app-layout>
  <!-- Content -->
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
      <!-- Page Header -->
      <div class="page-header">
          <div class="row align-items-center">
              <div class="col">
                  <h1 class="page-header-title">career</h1>
              </div>
              <!-- End Col -->

              <div class="col-auto">
                  <a class="btn btn-primary" href="{{ route('admin.career.index') }}">
                      <i class="bi-chevron-left me-1"></i> Back
                  </a>
              </div>
              <!-- End Col -->
          </div>
          <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <div class="card">
          <div class="card-body">
              <h4 class="card-title">{{ $career->title }}</h4>
              <p class="card-text">{!! $career->description !!}</p>

          </div>
          
      </div>

  </div>
  <!-- End Content -->
  @include('scripts.delete')

</x-app-layout>
