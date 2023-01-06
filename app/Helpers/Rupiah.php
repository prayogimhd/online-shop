<?php
function rupiah($angka)
{
    $hasil = number_format($angka, 0, ',', '.');
    return "Rp. " .  $hasil;
}
