<?php

namespace App\Exports;

use App\Models\System;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class SystemsExport implements FromView, WithCustomStartCell
{
    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.systems', [
            'systems' => System::all() // Fetch all data, or use a query builder to filter as needed
        ]);
    }

    public function startCell(): string
    {
        return 'A3'; // Start data from A3 to leave space for headers
    }
}
