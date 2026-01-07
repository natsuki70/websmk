<<<<<<< HEAD
<?php
$storageFolders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
];
foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}
=======
<?php
$storageFolders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
];
foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}
>>>>>>> 669716d01e9021675be4b3b148926841d8d324c3
require __DIR__ . '/../public/index.php';