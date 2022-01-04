@extends('../admin/layouts/master')

@section('container')

<div class="">
    <div class="p-5">
        @if (session()->has('tambahError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('tambahError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Jadwalkan Sidang!</h1>
        </div>
        <form action="/admin-sidang-jadwal" method="post">
            @csrf
            <input type="hidden" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="" name="id" value="{{ $id }}">
            <div class="form-group">
                <input type="date" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Tanggal Sidang" name="tanggal_sidang">
            </div>
            <div class="form-group">
                <select name="nip1" class="form-control text-center">
                    <option value="">-Set Dosen Penguji 1-</option>
                    @foreach ($dosen as $a)
                        <option value="{{ $a->NIP }}">{{ $a->NAMA }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="nip2" class="form-control text-center">
                    <option value="">-Set Dosen Penguji 2-</option>
                    @foreach ($dosen as $a)
                        <option value="{{ $a->NIP }}">{{ $a->NAMA }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="nip3" class="form-control text-center">
                    <option value="">-Set Dosen Penguji 3-</option>
                    @foreach ($dosen as $a)
                        <option value="{{ $a->NIP }}">{{ $a->NAMA }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Link Zoom Meeting" name="link_zoom">
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <a href="/admin-sidang" class="btn btn-danger btn-user btn-block">
                        Batal
                    </a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">
                        Tambah
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection    
