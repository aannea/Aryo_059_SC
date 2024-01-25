<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="styleshe
et"> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Biodata {{ $student->name }}</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="pt-3 d-flex justify-content-end align-items-center">
                    <h1 class="h2 mr-auto">Biodata {{ $student->name }}</h1>
                    <a href="{{ route('adminlte.edit', ['student' => $student->id]) }}" class="btn btn-primary">Edit
                    </a>
                    <form action="{{ route('adminlte.destroy', ['student' => $student->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                    </form>
                </div>
                <hr>
                @if (session()->has('pesan'))
                    <div class="alert alert-success">
                        {{ session()->get('pesan') }}
                    </div>
                @endif
                <ul>
                    <li>Foto: <br><img height="150px" src="{{ asset($student->image) }}" class="rounded"
                            alt="{{ $student->image }}"></li>
                    <li>NIM: {{ $student->nim }} </li>
                    <li>Nama: {{ $student->name }} </li>
                    <li>Jenis Kelamin:
                        {{ $student->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}
                    </li>
                    <li>Jurusan: {{ $student->departement }} </li>
                    <li>Alamat:
                        {{ $student->address == '' ? 'N/A' : $student->address }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>
