<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;

class EpisodesController
{
    public function __construct(private SeriesRepository $repository) {}

    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season) {
        DB::transaction(function () use ($request, $season) {
            $watchedIds = $request->episodes ?? [];

            $season->episodes()->update(['watched' => false]);

            if (!empty($watchedIds)) {
                $season->episodes()
                    ->whereIn('id', $watchedIds)
                    ->update(['watched' => true]);
            }
        });

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios atualizados com sucesso!');
    }
}
