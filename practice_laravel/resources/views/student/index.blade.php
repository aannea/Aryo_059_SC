<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    {{-- <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <title>Data Mahasiswa</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-end align-items-center">
                    <h2 class="mr-auto">Tabel Mahasiswa</h2>
                    <a href="{{ route('adminlte.create') }}" class="btn btn-primary">
                        Tambah Mahasiswa
                    </a>
                </div>
                @if (session()->has('pesan'))
                    <div class="alert alert-success">
                        {{ session()->get('pesan') }}
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $object)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td><img height="30px" src="{{ asset($object->image) }}" class="rounded"
                                        alt="{{ $object->image }}"></td>
                                <td><a
                                        href="{{ route('adminlte.show', ['student' => $object->id]) }}">{{ $object->nim }}</a>
                                </td>
                                <td>{{ $object->name }}</td>
                                <td>{{ $object->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                <td>{{ $object->departement }}</td>
                                <td>{{ $object->address == '' ? 'N/A' : $object->address }}</td>
                            </tr>
                        @empty
                            <td colspan="6" class="text-center">Tidak ada data...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>
