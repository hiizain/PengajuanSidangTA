@extends('../dosen/layouts/master')

@section('container')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Sidang (Dosen Pembimbing)</h1>
    <p class="mb-4">Tabel di bawah berisi data-data Jadwal Sidang TA sebagai Dosen Pembimbing.</p>

    <!-- Page Heading -->
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
                    <h6 class="m-0 font-weight-bold text-primary">Sidang</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Jadwal Sidang</th>
                            <th>Link Zoom</th>
                            <th>Status Sidang</th>
                            <th>Laporan Final</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIM</th>
                            <th>Jadwal Sidang</th>
                            <th>Link Zoom</th>
                            <th>Status Sidang</th>
                            <th>Laporan Final</th>
                            <th>Hasil</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($sidang as $item)
                            <tr>
                                <td>{{ $item->NIM }}</td>
                                <td>{{ $item->TANGGAL }}</td>
                                <td>{{ $item->LINK_ZOOM }}</td>
                                <td>
                                    <?php
                                     if ($item->STATUS == 3){
                                        echo "Selesai";
                                    }else if ($item->STATUS == 2){
                                        echo "Menunggu Dijadwalkan";
                                    } else if ($item->STATUS == 1){
                                        echo "Telah Dijadwalkan";
                                    } else echo "Ditolak";
                                    ?>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->PATH_LAPORAN_TA_FINAL) }}" 
                                        target="_blank">
                                        {{ $item->LAPORAN_TA_FINAL }}
                                    </a>
                                </td>
                                <td>{{ $item->HASIL }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection 

