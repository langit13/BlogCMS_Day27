@extends('layouts.app')
    <form action="{{ route('two-factor.verify') }}" method="post">
        @csrf
        <label for="code">Two Factor Code</label>
        <input type="text" name="code" id="code" required>
        <button type="submit">Verify</button>
    </form>
    if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
@endsection