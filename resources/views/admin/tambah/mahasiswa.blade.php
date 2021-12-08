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
            <h1 class="h4 text-gray-900 mb-4">Tambahkan Data Kecamatan!</h1>
        </div>
        <form action="/admin-mahasiswa-create" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="NIM" name="nim">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Nama Mahasiswa" name="nama">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name="jenis_kelamin" class="form-control text-center">
                        <option value="">- Pilih Jenis kelamin -</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <input type="date" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Tanggal Lahir" name="tanggal_lahir">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Alamat" name="alamat">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Prodi" name="prodi">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="No Telepon" name="no_telpon">
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user text-center" id="exampleFirstName"
                        placeholder="Email" name="email">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <a href="/admin-mahasiswa" class="btn btn-danger btn-user btn-block">
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
