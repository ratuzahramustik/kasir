<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    protected $userData = [];

    public function collection()
    {
        $users = User::latest()->get();

        foreach ($users as $user) {
            $this->userData[] = [
                $user->name,
                $user->email,
                $user->role,
                Carbon::parse($user->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i')
            ];
        }

        return collect($this->userData);
    }

    public function map($row): array
    {
        return $row;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Role',
            'Tanggal Dibuat',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->setCellValue('A1', 'Laporan Data User');
            },
        ];
    }
}
