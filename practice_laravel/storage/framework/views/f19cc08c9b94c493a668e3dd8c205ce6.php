<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Biodata <?php echo e($student->name); ?></title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="pt-3 d-flex justify-content-end align-items-center">
                    <h1 class="h2 mr-auto">Biodata <?php echo e($student->name); ?></h1>
                    <a href="<?php echo e(route('adminlte.edit', ['student' => $student->id])); ?>" class="btn btn-primary">Edit
                    </a>
                    <form action="<?php echo e(route('adminlte.destroy', ['student' => $student->id])); ?>" method="POST">
                        <?php echo method_field('DELETE'); ?>
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                    </form>
                </div>
                <hr>
                <?php if(session()->has('pesan')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('pesan')); ?>

                    </div>
                <?php endif; ?>
                <ul>
                    <li>Foto: <br><img height="150px" src="<?php echo e(asset($student->image)); ?>" class="rounded"
                            alt="<?php echo e($student->image); ?>"></li>
                    <li>NIM: <?php echo e($student->nim); ?> </li>
                    <li>Nama: <?php echo e($student->name); ?> </li>
                    <li>Jenis Kelamin:
                        <?php echo e($student->gender == 'P' ? 'Perempuan' : 'Laki-laki'); ?>

                    </li>
                    <li>Jurusan: <?php echo e($student->departement); ?> </li>
                    <li>Alamat:
                        <?php echo e($student->address == '' ? 'N/A' : $student->address); ?>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>
<?php /**PATH C:\VSCodeProjects\Kampus\sem5\21102059-sc1-pw2324\practice_laravel\resources\views/student/show.blade.php ENDPATH**/ ?>