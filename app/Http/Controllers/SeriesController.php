<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        // $series = [
        //     'Punisher',
        //     'Lost',
        //     'Grey\'s Anatomy'
        // ];
        $series = DB::select('SELECT nome FROM series;');


        // return view('listar-series', [
        //     'series' => $series
        // ]);

        // $html = '<ul>';
        // foreach ($series as $serie) {
        //     $html .= "<li>$serie</li>";
        // }
        // $html .= '</ul>';

        // return $html;

        // return view('listar-series', compact('series'));

        return view('series.index')->with('series', $series);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $nomeSerie = $request->input('nome');

        if (DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])) {
                return "OK";
        } else {
            return "Deu erro";
        }

    }
}
