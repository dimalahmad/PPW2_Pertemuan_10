@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-14">
        <div class="card">
            <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>
                <!-- Bagian untuk Inventory Buku -->
                <div class="container mt-4">
                    <!-- Header -->
                    <h1 class="text-center mb-4">INVENTORY BUKU</h1>

                    <!-- Tombol untuk menambah buku dan pencarian -->
                    @auth
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
                            <form action="{{ route('buku.search') }}" method="get" class="d-flex">
                                @csrf
                                <input type="text" name="kata" class="form-control me-2" placeholder="Cari ..." style="width: 100%;">
                                <button type="submit" class="btn btn-outline-secondary">Cari</button>
                            </form>
                        </div>
                    @endauth

                    <!-- Tabel data buku -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Harga</th>
                                <th>Tanggal Terbit</th>
                                @auth
                                    <th>Aksi</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banyak_buku as $buku)
                            <tr> 
                                <td>{{ $buku->id }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                                @auth
                                    <td>
                                        <!-- Tombol Ubah dan Hapus -->
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning rounded-end me-2">Ubah</a>
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Jumlah total data:</strong></td>
                                <td><strong>{{ $jumlah_buku }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Total harga semua buku:</strong></td>
                                <td><strong>Rp. {{ number_format($total_harga, 2, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div>{{ $banyak_buku->links('pagination::bootstrap-5') }}</div>
                    <div><strong>Jumlah Buku: {{$jumlah_buku}}</strong></div>
                </div>
        </div>
    </div>
</div>
@endsection