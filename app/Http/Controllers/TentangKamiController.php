<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        // Data tim (4 orang)
        $teamMembers = [
            [
                'photo' => asset('assets/ilyas.jpeg'),
                'name' => 'Ilyasha Erfrian ',
                'role' => 'Mahasiswa STT Nurul Fikri',
                'github' => 'https://github.com/ilyasha04',
                'instagram' => 'https://instagram.com/ilyashaajah_'
            ],
        ];

        // Kirim data ke view
        return view('tentang', compact('teamMembers'));
    }
}
