<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // $series = [
        //     'Punisher',
        //     'Lost',
        //     'Grey\'s Anatomy'
        // ];

        // $series = DB::select('SELECT nome FROM series;');

         $series = Series::all();

        // $series = Serie::query()->orderBy('nome')->get();

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
        // $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create() {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {
        // $nomeSerie = $request->input('nome');

        // if (DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])) {
        //         return "OK";
        // } else {
        //     return "Deu erro";
        // }

        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();

        $request->validate([

        ]);
        $serie = Series::create($request->all());
        // Menos elegante
        // $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series) {
        $series->delete();
        // Precisa do request e é menos elegante
        // $request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series) {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
            // ->with('mensagem.sucesso', "Série '{$series->nome}' alterada com sucesso!");
    }
}
