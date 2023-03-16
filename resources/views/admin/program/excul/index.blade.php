<x-app-layout>
    @push('styles')

    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Excules</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.excul.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                    <a class="btn btn-primary" href="{{ route('admin.excul.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->


        </div>
        <form action="">
                {{-- level --}}
            <div class="row mb-3">
                {{-- <div class="col-md-3">
                    <select name="level" class="form-control" onchange="form.submit()">
                        <option value="">Semua Jenjang</option>
                        @foreach ($levels as $item)
                            <option value="{{ $item->slug }}"
                                {{ @$_GET['level'] == $item->slug ? 'selected' : ''}}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- Searching --}}
            <div class="col-md-5 col-lg-5">

                <!-- Input Card -->
                <div class="input-group input-group-merge">
                  {{-- <span class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </span> --}}
                  <input type="text" class="form-control" placeholder="Search for Title ..." aria-label="Search" name="search" value="{{ @$_GET['search'] }}">
                  <button class="btn btn-warning"><i class="bi-search"><a href="{{ @$_GET['search'] }}"></a></i></button>
                </div>
                <!-- End Input Card -->

            </div>
            </div>

            </form>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Data Excule</h4>
                <div class="table">
                    <table class="table table-thead-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($exculs as $excul)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td scope="row">

                                            <span class="avatar avatar-sm avatar-circle">
                                                {{-- @if ($exculs->getFirstMedia('images'))
                                        <img src="{{ $exculs->getFirstMediaUrl('images') }}" class="avatar-img" alt="">
                                    @endif --}}
                                                <img class="avatar-img" src="{{$excul->getFirstMediaUrl('images')}}" alt="######">
                                              </span>

                                              {{ $excul->name }}

                                        </td>
                                    <td>{{$excul->user->name}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="formSwitch1">
                                            <label class="form-check-label" for="formSwitch1"></label>
                                          </div>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.excul.edit', $excul) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.excul.show', $excul) }}">Show</a>
                                        <form action="{{ route('admin.excul.destroy', $excul) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{ $excul->withQueryString()->links()}} --}}
        </div>
        {{ $exculs->withQueryString()->links()}}
    </div>
    <!-- End Content -->

    @include('scripts.delete')
</x-app-layout>
