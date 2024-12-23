<?php
require 'vendor/autoload.php';

use Kunalvarma05\Dropbox\Dropbox;
use Kunalvarma05\Dropbox\DropboxApp;
use Kunalvarma05\Dropbox\DropboxFile;


function uploadToDropbox($accessToken, $localFilePath, $dropboxPath)
{
    // Inisialisasi aplikasi Dropbox
    $app = new DropboxApp($accessToken);
    $dropbox = new Dropbox($app);

    try {
        // Unggah file ke Dropbox
        $dropboxFile = new DropboxFile($localFilePath);
        $uploadedFile = $dropbox->upload($dropboxFile, $dropboxPath, ['autorename' => true]);

        echo "File berhasil diunggah ke Dropbox: " . $uploadedFile->getName() . "\n";
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Proses file yang diunggah dari form HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $accessToken = 'sl.u.AFaQFjqrVvlt-dOa8ulIlAUXprLq3TOUrf8GyAMyIHmRFo_9IBX0sAzx7Daerbs2JayuSS-QuYfL69JW8JY6smsB3ySJgkOk6mc7pLmjH4jsYoTrTu1N_nq7Vi5IlkgyGNQJ6j_932nif3n2tEa2xLkP_xbn25s16N2ANj_fCptQlSueAcKt6uZ0R_hyQhx84dYN30UagVdy6HZjMNU0oW-2vfBTFRA0NjWnVlfPXmm1ZqOlbeYFXy4Nx7e6kIn0Cuy-vYzaIv54gnGytjtBB8ZXs4rNB2_iZ-4h33REtYii9KEJ-LMVEMdJ4THFAbzu492RUKQw5fBzxl845QSSj61AgyuMUDN-psT1p6WYxSOeHW-4NJ9Sv8sejHwj6OS5qqv2jaHA67YjTS9BcFCBRnOrP1PXp0FI5M3vsu7Qd7_X4n9aKVSMZNVzHB3H9x7FM5o2JPQV12XxjlL8Er4Z1bxCTaiWN2pdTUvb6WiLLtg8M4Eg2D-frnnZnrhg_OvQsyyoKLG5uUQT3SgJkLPWz8Av1hOrE7e5SYMdZns9emzbR3KxTY29NV-ikzcZ5mgvYkLv3WzP5OXMdug9Oa14Oxb8im589JNC3Dk4gUVMAbzvbfQw7uxL-UECOa7XzlfThGt0Sa99VlM4AI6zgiOdDE_IdtDecDhp9uvuRan5bj-580cyD4GTd0jxHLa3NP1WuMrz0fwB0QWwG0A-ahrttF7v3ufB_ZF4JsNiDMAXIVc7DguBvWKPT9-vfQlaZJ0HcJHVcoM4HxnrJ_SdZkeMaD_Vsnf3FpB6N-NaHo4F6eOC2qTTxl1PEoiT-FUPHYK4EvylGH7L3kfZZEza2u7ehgqe92Jojmx1r2HsxRjxewM2fu0L2VajF15iMGQwbskPdt1kJS1yaIpBX74ZfbX9JBG8Gl9XFs-NJi11LlAhlSjrasI2hNVK5BhzbAdMHd3MoT86r_iDq0YcckAeIhkv3QQLB03YBQFfIVwkmFPeS9MiPV1BFSzlAD-G8_7rWxso8N1RK96Qnz4vU4TQI2NeU-gg7jsg5XvbNKscWRBOi16AbSx2krtWu998-poj8eJjltQZMDN3NiIjURi0popGPUhdNQkQT0zsCVH40B807Hylcfk4pmY7RrysNWCODql5QOWRcGsCa37vXLXWhRSpokkOYU_bCVCc-ZqH-AfoqJ2PG9Sy_wf0qiXGphBg_ZSnw2Sm-WZSsxaVy8vzVqjp7GE8TsCk1y6XsJgTQnIUvZTZxJLtB9OWoUyAAUZUWhlqLb0G8WO6f_JnJ1aT-qUzVdqRYF7flXdIX_dg4Szqj6izmwrZ_ng40oLJoe2V5lcErZJW5ENPS0lKtX_vCnF8hNpV-a0kxriN8Q_xqOEXV4IwF_2Eq0XKLiZbdMgYuUWWeFi9w16wyhJV-Ael9OYEgbOzo42AeyzefFRmUMaqfUGULkQRDlnqDJkNqr-qKgJKk_fjyt97ZVgv7t09AidQu6yh'; // Ganti dengan Access Token Dropbox Anda
    $uploadFolder = 'uploads'; // Folder sementara untuk menyimpan file yang diunggah

    // Pastikan folder sementara ada
    if (!file_exists($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    // Ambil informasi file
    $file = $_FILES['file'];
    $tempPath = $file['tmp_name'];
    $fileName = basename($file['name']);
    $localFilePath = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
    $dropboxPath = '/' . $fileName; // Path di Dropbox (di root Dropbox)

    // Pindahkan file ke folder sementara
    if (move_uploaded_file($tempPath, $localFilePath)) {
        uploadToDropbox($accessToken, $localFilePath, $dropboxPath);
        unlink($localFilePath); // Hapus file sementara setelah diunggah
    } else {
        echo "Gagal mengunggah file.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
