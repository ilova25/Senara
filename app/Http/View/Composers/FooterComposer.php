<?php

namespace App\Http\View\Composers;

use App\Models\informasi;
use Illuminate\View\View;
use App\Models\InformasiFooter;

class FooterComposer
{
    public function compose(View $view)
    {
        // Ambil data dari database
        $informasi = informasi::first();

        // Kirim ke view footer
        $view->with('informasi', $informasi);
    }
}
