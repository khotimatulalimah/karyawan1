@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Laporan Pendapatan</h1>

    <!-- Tabel Laporan Pendapatan -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hasil Pendapatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendapatan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_awal }} - {{ $item->tanggal_akhir }}</td>
                    <td>Rp {{ number_format($item->pendapatan, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('report.print', $item->id) }}" method="POST" target="_blank">
                            @csrf
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol untuk kembali -->
</div>
@endsection