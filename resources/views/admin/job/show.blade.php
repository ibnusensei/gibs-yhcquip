<x-app-layout>
  <!-- Content -->
  @push('styles')
      <style>
      </style>
  @endpush
  <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
          <div class="row align-items-center">
              <div class="col">
                  <h1 class="page-header-title">job</h1>
              </div>
              <!-- End Col -->


              <div class="col-auto">
                  <a class="btn btn-primary" href="{{ route('admin.job.index') }}">
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
              <h1 class="card-title">Posisi: {{ $job->posisi }}</h1>
              <h3>Unit: {{ $job->unit }}</h3>
              <h5>Deadline pendaftaran: {{ $job->start_date }} - {{ $job->end_date }}</h5>
              <p class="card-text">{!! $job->description !!}</p>

          </div>    
      </div>

      <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                @foreach ($job->getMedia('image') as $image)
                    <div class="col-md-4 mb-4">
                        <div class="img-custom rounded mb-2">
                        <img src="{{ $job->getFirstMediaUrl('image') }}" class="img-thumbnail" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </div>

  </div>
  <!-- End Content -->
  @include('scripts.delete')

</x-app-layout>
