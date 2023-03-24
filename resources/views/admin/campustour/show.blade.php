<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
    <div class="page-header">
    <div class="row align-items-center">
      <div class="col-sm mb-2 mb-sm-0">
        <h2 class="page-header-title">Campus Tour</h2>
      </div>
  
      <div class="col-sm-auto">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.campustour.index') }}">
          <i class="bi bi-replay"></i> Back
        </a>
      </div>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="card">
    <div class="card-body">
            <!-- Card -->
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row no-gutters">
            <div class="col-md-4">
                <img class="img-fluid rounded" src="{{ $campustour->getFirstMediaUrl('image', 'thumbs') }}" alt="image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">{{ $campustour->title }}</h5>
                <p class="card-text">{{ $campustour->description }}</p>
            </div>
            </div>
            </div>
        </div>
        <!-- End Card -->
        </div>
    </div>
 </div>
</x-app-layout>

