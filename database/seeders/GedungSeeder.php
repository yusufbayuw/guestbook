<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();
        DB::table('gedungs')->insert([
            ['nama' => 'Unit Daycare, KB & TK', 'alamat' => 'Jl LLRE Martadinata 91, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'Unit SD', 'alamat' => 'Jl LLRE Martadinata 52, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'Unit SMP', 'alamat' => 'Jl LLRE Martadinata 52, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'Unit SMA', 'alamat' => 'Jl LLRE Martadinata 52, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'TBU 1', 'alamat' => 'Jl LLRE Martadinata 93, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'TBU 2', 'alamat' => 'Jl Setiabudi 122A, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'TBU 3', 'alamat' => 'Jl PHH Mustofa 55, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'Unit ADM', 'alamat' => 'Jl LLRE Martadinata 52, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['nama' => 'Gedung Olah Raga', 'alamat' => 'Jl Surapati 155, Bandung', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);
    }
}
