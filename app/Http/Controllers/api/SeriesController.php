<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller {
    public function __construct(private SeriesRepository $seriesRepository)
    {

    }

    // public function index() {
    //     return Series::all();
    // }

    public function index(Request $request) {
        // if (!$request->has('nome')) {
        //     return Series::all();
        // } else {
        $query = Series::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }
        return $query->paginate(5);
        //    return Series::whereNome($request->nome)->get(); // igual a where('nome',$request-nome)!
        // }
    }

    public function store(SeriesFormRequest $request) {
        return response()
            ->json($this->seriesRepository->addSeries($request), 201);
    }

    // public function show(int $series) {      // Séries + temp + ep
    //     $series = Series::whereId($series)->with('seasons.episodes')->first();
    //     return $series;
    // }

    // public function show(Series $series) {
	//     return $series;
    // }

    public function show(int $series) {
        $seriesModel = Series::with('seasons.episodes')->find($series); // 1 q!
        if ($seriesModel === null) {
            return response()->json(['message' => 'Série não encontrada'], 404);
        } else {
            return $seriesModel; // ->with('seasons.episodes')->get(); // 2 queries!
        }
    }

    public function update(Series $series, SeriesFormRequest $request) {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $series) {
        Series::destroy($series);
        return response()->noContent();
    }
}
