@extends('../admin/layouts/master')

@section('container')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Mahasiswa</h1>
    <p class="mb-4">Tabel di bawah berisi data-data yang berkaitan dengan akun Mahasiswa.</p>

    <div>
        @if (session()->has('tambahSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('tambahSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('updateSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('restoreSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('restoreSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif   
        @if (session()->has('deleteError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deleteError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif   
    </div> 

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-6 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="/admin-mahasiswa-tambah" class="btn btn-primary tombol">Tambah Data</a>
                    <a href="#" class="btn btn-warning tombol">Restore Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Prodi</th>
                            <th>Nomor Telp.</th>
                            <th>Email</th>
                            <th>Nama Dosen Pembimbing</th>
                            <th>Set Dosen Pembimbing</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Prodi</th>
                            <th>Nomor Telp.</th>
                            <th>Email</th>
                            <th>Nama Dosen Pembimbing</th>
                            <th>Set Dosen Pembimbing</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($mahasiswa as $item)
                            <tr>
                                <td>{{ $item->NIM }}</td>
                                <td>{{ $item->NAMA }}</td>
                                <td>{{ $item->JENIS_KELAMIN }}</td>
                                <td>{{ $item->TANGGAL_LAHIR }}</td>
                                <td>{{ $item->ALAMAT }}</td>
                                <td>{{ $item->PRODI }}</td>
                                <td>{{ $item->NO_TELPON }}</td>
                                <td>{{ $item->EMAIL }}</td>
                                <td>
                                    {{ $item->NIP_DOSEN }}
                                </td>
                                <td>
                                    <form action="/admin-mahasiswa-setDosen" method="post">
                                        @csrf
                                        <div class="row pb-3">
                                            <div class="col-md-12">
                                                <input type="hidden" name="nim" value="{{ $item->NIM }}">
                                                <select name="NIP" class="form-control text-center">
                                                    <option value="">-Set Dosen-</option>
                                                    @foreach ($dosenSet as $a)
                                                        <option value="{{ $a->NIP }}">{{ $a->NAMA }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" name="submit" class="btn btn-success btn-user btn-block">
                                                Set
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form action="/edit-balita" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->ID_BALITA }}">
                                        <button class="btn btn-primary tombol border-0">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="/balita-hapus" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->ID_BALITA }}">
                                        <button class="btn btn-danger tombol border-0" onclick="return confirm('Akan menghapus data');">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection    
