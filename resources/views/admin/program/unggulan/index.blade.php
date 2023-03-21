<x-app-layout>
    @push('styles')

    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Program Unggulan</h1>
                </div>
                <!-- End Col -->
                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.unggulan.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                     <a class="btn btn-primary" href="{{ route('admin.unggulan.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>

                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <form action="">
            {{-- program_category --}}
        <div class="row mb-3">

            {{-- <div class="col d-md-flex align-items-md-center text-center">
                <span class="d-block me-md-3 mb-2 mb-md-1">program_category:</span>
                <a class="btn btn-soft-secondary btn-xs rounded-pill m-1" href="javascript:;">SMP</a>
                <a class="btn btn-soft-secondary btn-xs rounded-pill m-1" href="javascript:;">SMA</a>
              </div> --}}

            <div class="col-md-5">
                <select name="program_category" class="form-select" onchange="form.submit()">
                    <option value="">Semua Program</option>
                    @foreach ($program_categories as $item)
                        <option value="{{ $item->slug }}"
                            {{ @$_GET['program_category'] == $item->slug ? 'selected' : ''}}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Searching --}}
            <div class="col-md-5 col-lg-5">

                  <!-- Input Card -->
                  <div class="input-group input-group-merge">

                    <input type="text" class="form-control" placeholder="Search for Title ..." aria-label="Search" name="search" value="{{ @$_GET['search'] }}">
                    <button class="btn btn-warning"><i class="bi-search"><a href="{{ @$_GET['search'] }}"></a></i></button>
                  </div>
                  <!-- End Input Card -->

              </div>



        </form>


        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Data Program Unggulan</h4>
                <div class="table-responsive">
                    <table class="table table-thead-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($unggulans as $unggulan)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td scope="row">
                                        <span class="avatar avatar-sm avatar-circle">
                                            <img class="avatar-img" src="{{$unggulan->getFirstMediaUrl('images')}}" alt="######">
                                          </span>

                                            {{ Str::limit($unggulan->title , 20, '...') }}


                                    </td>
                                    <td>{{ Str::limit($unggulan->program_category->name  , 20, '...') }}</td>
                                    <td>{{ $unggulan->user->name}}</td>
                                    <td>
                                        <form class="publishForm" action="{{ route('admin.unggulan.publish', $unggulan->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input class="form-check-input publishSwitch" type="checkbox" name="is_published" {{ $unggulan->is_published ? 'checked' : '' }}>
                                                {{-- <label class="form-check-label" for="publishSwitch">{{ $unggulan->is_published ? '' : '' }}</label> --}}
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.unggulan.edit', $unggulan) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.unggulan.show', $unggulan) }}">Show</a>
                                        <form action="{{ route('admin.unggulan.destroy', $unggulan) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="55" class="text-center pt-5">No Data</td>

                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
            {{ $unggulans->withQueryString()->links()}}

    </div>
    <!-- End Content -->

    @include('scripts.delete')
    @include('scripts.publish')
</x-app-layout>
