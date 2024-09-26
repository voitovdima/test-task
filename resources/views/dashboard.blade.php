<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h1>Special Page for {{ $player->username }}</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('regenerate.link', ['link' => $player->unique_link]) }}" method="POST">
    @csrf
    <button type="submit">Regenerate Link</button>
</form>

<form action="{{ route('deactivate.link', ['link' => $player->unique_link]) }}" method="POST">
    @csrf
    <button type="submit">Deactivate Link</button>
</form>

<form action="{{ route('imfeelinglucky', ['link' => $player->unique_link]) }}" method="POST">
    @csrf
    <button type="submit">I'm Feeling Lucky</button>
</form>

<a href="{{ route('history', ['link' => $player->unique_link]) }}">View History</a>


@if($luckyhistories ?? false)
    <p>Random Number: {{ $luckyhistories->random_number }}</p>
    <p>Result: {{ $luckyhistories->result }}</p>
    <p>Winning Amount: {{ $luckyhistories->win_amount }}</p>
@else
    <p>Try to play</p>
@endif

@if (isset($history) && count($history) > 0)
    <h2>History</h2>
    <ul>
        @foreach ($history as $luckyhistories)
            <li>{{ $luckyhistories->random_number }} - {{ $luckyhistories->result }} - {{ $luckyhistories->win_amount }}</li>
        @endforeach
    </ul>
@endif
</body>
</html>
