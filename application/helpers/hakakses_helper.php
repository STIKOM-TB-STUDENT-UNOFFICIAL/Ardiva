<?php
function cek_akses_file($file_prodi, $user_prodi)
{
    if ($user_prodi == 'UV') return 'full'; 
    if ($file_prodi == $user_prodi) return 'full';
    if ($file_prodi == 'UV') return 'read';

    return 'deny';
}
?>