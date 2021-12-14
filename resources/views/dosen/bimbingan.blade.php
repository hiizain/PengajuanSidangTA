@extends('../dosen/layouts/master')

@section('container')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Balita</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

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
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Link Zoom</th>
                            <th>Status</th>
                            <th>Laporan TA</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Link Zoom</th>
                            <th>Status</th>
                            <th>Laporan TA</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($bimbingan as $item)
                            <tr>
                                <td>{{ $item->TANGGAL }}</td>
                                <td><?php
                                    if ($item->STATUS == 1)
                                    echo "Link Zoom Active";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($item->STATUS == 2){
                                        echo "Menunggu Disetujui";
                                    } else if ($item->STATUS == 1){
                                        echo "Disetujui";
                                    } else if ($item->STATUS == 0){
                                        echo "Ditolak";
                                    } else echo "Selesai";
                                    ?>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->PATH_LAPORAN_TA) }}" 
                                        target="_blank">
                                        {{ $item->LAPORAN_TA }}
                                    </a>
                                </td>
                                <td>
                                    <form action="/dosen-bimbingan-komentar" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->ID_BIMBINGAN }}">
                                        <textarea class="form-control" rows="3" id="textarea" name="komentar">{{ $item->KOMENTAR }}</textarea>
                                        <br>
                                        <button class="btn btn-success tombol border-0">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li class="pb-1 pl-2">
                                            <form action="/dosen-bimbingan-setuju" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->ID_BIMBINGAN }}">
                                                <input type="hidden" name="nim" value="{{ $NIM }}">
                                                <button class="btn btn-success tombol border-0 text-center" name="op">
                                                    Setuju
                                                </button>
                                            </form>
                                          </li>
                                          <li class="pb-1 pl-2">
                                            <form action="/dosen-bimbingan-menolak" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->ID_BIMBINGAN }}">
                                                <input type="hidden" name="nim" value="{{ $NIM }}">
                                                <button class="btn btn-danger tombol border-0 text-center" name="op">
                                                    Tolak
                                                </button>
                                            </form>
                                          </li>
                                          <li class="pb-1 pl-2">
                                            <form action="/dosen-bimbingan-ACCFinal" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->ID_BIMBINGAN }}">
                                                <input type="hidden" name="nim" value="{{ $NIM }}">
                                                <button class="btn btn-primary tombol border-0 text-center" name="op">
                                                    ACC Final
                                                </button>
                                            </form>
                                          </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection    
