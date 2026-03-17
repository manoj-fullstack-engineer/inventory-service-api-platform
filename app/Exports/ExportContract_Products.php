<?php

namespace App\Exports;

use App\Contract_Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportContract_Products implements FromView
{
    /**
     * melakukan format dokumen menggunakan html, maka package ini juga menyediakan fungsi lainnya agar dapat me-load data tersebut dari file html / blade di Laravel
     */
    use Exportable;

    public function view(): View
    {
        // TODO: Implement view() method.
        return view('Contract_Products.contractProductAllExcel',[
            'contract_products' => Contract_Product::all()
        ]);
    }
}
