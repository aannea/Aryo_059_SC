<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <title>Data Mahasiswa</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-end align-items-center">
                    <h2 class="mr-auto">Tabel Mahasiswa</h2>
                    <a href="<?php echo e(route('adminlte.create')); ?>" class="btn btn-primary">
                        Tambah Mahasiswa
                    </a>
                </div>
                <?php if(session()->has('pesan')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('pesan')); ?>

                    </div>
                <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <th><?php echo e($loop->iteration); ?></th>
                                <td><img height="30px" src="<?php echo e(asset($object->image)); ?>" class="rounded"
                                        alt="<?php echo e($object->image); ?>"></td>
                                <td><a
                                        href="<?php echo e(route('adminlte.show', ['student' => $object->id])); ?>"><?php echo e($object->nim); ?></a>
                                </td>
                                <td><?php echo e($object->name); ?></td>
                                <td><?php echo e($object->gender == 'P' ? 'Perempuan' : 'Laki-laki'); ?></td>
                                <td><?php echo e($object->departement); ?></td>
                                <td><?php echo e($object->address == '' ? 'N/A' : $object->address); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td colspan="6" class="text-center">Tidak ada data...</td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>
<?php /**PATH C:\VSCodeProjects\Kampus\sem5\21102059-sc1-pw2324\practice_laravel\resources\views/student/index.blade.php ENDPATH**/ ?>