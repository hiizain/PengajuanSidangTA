@extends('../mahasiswa/layouts/master')

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
            <h1 class="h4 text-gray-900 mb-4">Ajukan Penelitian!</h1>
        </div>
        <form action="/mahasiswa-penelitian-create" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Nim" name="nim">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Judul TA" name="judul_ta">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <a href="/mahasiswa-bimbingan" class="btn btn-danger btn-user btn-block">
                        Batal
                    </a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">
                        Tambah
                    </button>
                </div>
            </div>
            <hr>
        </form>
    </div>
</div>

@endsection    
