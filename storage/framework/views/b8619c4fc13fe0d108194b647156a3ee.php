<div class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 p-6">
    <h1 class="text-xl font-bold mb-8">LearnFlux</h1>

    <?php
        $role = Auth::user()->role;
    ?>

    <ul class="space-y-4">

        
        <li>
            <a href="<?php echo e(route('dashboard.' . ($role === 'kepala_sekolah' ? 'kepsek' : ($role === 'guru' ? 'guru' : ($role === 'siswa' ? 'siswa' : ($role === 'orang_tua' ? 'orangtua' : 'dinas')))))); ?>"
                class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                <?php echo $__env->make('components.icons.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Dashboard</span>
            </a>
        </li>

        
        <?php if($role === 'guru'): ?>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.data-guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Data Guru</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.jadwal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Jadwal</span>
                </a>
            </li>
        <?php endif; ?>

        
        <?php if($role === 'siswa'): ?>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.data-siswa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Data Siswa</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.nilai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Nilai</span>
                </a>
            </li>
        <?php endif; ?>

        
        <?php if($role === 'kepala_sekolah'): ?>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.laporan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Laporan Sekolah</span>
                </a>
            </li>
        <?php endif; ?>

        
        <?php if($role === 'dinas'): ?>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.dashboard-dinas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Dashboard Dinas</span>
                </a>
            </li>
        <?php endif; ?>

        
        <?php if($role === 'orang_tua'): ?>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    <?php echo $__env->make('components.icons.profil', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span>Profil Anak</span>
                </a>
            </li>
        <?php endif; ?>

        
        <li class="pt-10">
            <a href="<?php echo e(route('logout')); ?>"
               class="flex items-center space-x-3 text-red-600 hover:text-red-800">
                <?php echo $__env->make('components.icons.logout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Logout</span>
            </a>
        </li>

        
        <li>
            <a href="<?php echo e(route('guru.nilai')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.nilai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Rekap Nilai</span>
            </a>
        </li>

        
        <li>
            <a href="<?php echo e(route('kepsek.laporan')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.laporan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Laporan Nilai</span>
            </a>
        </li>

        
        <li>
            <a href="<?php echo e(route('guru.jadwal')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.jadwal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Kelola Jadwal</span>
            </a>
        </li>

        
        <li>
            <a href="<?php echo e(route('siswa.jadwal')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.jadwal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Jadwal Pelajaran</span>
            </a>
        </li>

        
        <li>
            <a href="<?php echo e(route('chat.index')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.pesan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Pesan</span>
            </a>
        </li>

        
        <?php if(Auth::user()->role == 'guru'): ?>
        <li>
            <a href="<?php echo e(route('nilai.index')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.nilai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Input Nilai</span>
            </a>
        </li>
        <?php endif; ?>

        
        <?php if(Auth::user()->role == 'siswa'): ?>
        <li>
            <a href="<?php echo e(route('nilai.siswa')); ?>" class="sidebar-item">
                <?php echo $__env->make('components.icon.nilai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span>Nilai Saya</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if(Auth::user()->role == 'guru'): ?>
<a href="<?php echo e(route('jadwal.index')); ?>" class="sidebar-item">
    <?php echo $__env->make('components.icon.jadwal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <span>Jadwal Pelajaran</span>
</a>
<?php endif; ?>

<?php if(Auth::user()->role == 'siswa'): ?>
<a href="<?php echo e(route('jadwal.siswa')); ?>" class="sidebar-item">
    <?php echo $__env->make('components.icon.jadwal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <span>Jadwal Kelas</span>
</a>
<?php endif; ?>

<li>
    <a href="<?php echo e(route('tugas.index')); ?>" class="flex items-center gap-3">
        <?php echo $__env->make('components.icons.file-upload', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <span>Tugas</span>
    </a>
</li>

    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\lms_project\resources\views/components/sidebar.blade.php ENDPATH**/ ?>