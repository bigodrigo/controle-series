<x-mail::message>
# {{ $nomeSerie }} criada

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios.

Acesse aqui:

<x-mail::button :url="route('seasons.index', $idSerie)">
Ver série
</x-mail::button>

Até logo,<br>
{{ config('app.name') }}
</x-mail::message>
