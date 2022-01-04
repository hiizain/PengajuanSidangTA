@extends('../mahasiswa/layouts/master')

@section('container')

<div class="container mt-5">
    <div class="row justify-content-md-center">

        <!-- Earnings (Monthly) Card Example -->
        <div class="">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body row align-items-center">
                    <div class="col-lg-9 mr-2">
                        <div>
                            <h2>Profil</h2>
                        </div>
                        <div>
                            <table class="">
                                <tr>
                                    <th>Nama</th>
                                    <td>: {{ $mahasiswa->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>: {{ $mahasiswa->NIM }}</td>
                                </tr>
                                <tr>
                                    <th>Prodi</th>
                                    <td>: {{ $mahasiswa->PRODI }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row justify-content-end" style="font-size: 80px">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> 

@endsection