<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class AdminController extends Controller
{

    public function dashboard()
    {
        $db = Database::connect();

        $data['title'] = "Dashboard";
        $data['totalPremios'] = $db->table('premios')->countAll();
        $data['totalSorteos'] = $db->table('sorteos')->countAll();
        $data['totalParticipantes'] = $db->table('sorteo_participantes')->countAll();
        //$data['totalGanadores'] = $db->table('sorteo_ganadores')->countAll();
        $data['totalGanadores'] = $db->table('sorteo_participantes')
                             ->where('es_ganador', 1)
                             ->countAllResults();


        return view('admin/dashboard', $data);
    }
}
