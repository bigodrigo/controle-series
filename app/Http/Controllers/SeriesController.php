<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

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
}
