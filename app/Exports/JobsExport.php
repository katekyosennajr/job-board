<?php

namespace App\Exports;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Job::all(['id', 'title', 'description', 'location', 'job_type', 'kategori', 'min_salary', 'max_salary', 'status', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'ID', 'Title', 'Description', 'Location', 'Job Type', 'Category', 'Min Salary', 'Max Salary', 'Status', 'Created At'
        ];
    }
}
