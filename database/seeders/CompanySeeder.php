<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = [
            [
                'company_name' => 'PT. Sejahtera',
                'address' => 'Jl. Raya No. 1',
                'telephone' => '08123456789',
                'email' => 'sejahtera@company.com',
                'website' => 'www.sejahtera.com',
                'company_logo' => 'logo-biner.png',
                'description' => 'Perusahaan yang bergerak di bidang jasa',
            ]
        ];

        foreach ($company as $key => $value) {
            Company::create($value);
        }
    }
}
