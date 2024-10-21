@extends('front.layout.template')

@section('title', 'NArticles - ebula Blog')


@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="mb-5">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="input-group">
                        <input class="form-control" type="text" name="keyword" placeholder="Search Articles...." />
                        <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
                </div>
            </form>
        </div>

        @if ($keyword)
            <p>Showing articles with keyword : <b>{{ $keyword }}</b></p>
            <a  href="{{ url('articles') }}" class="btn btn-secondary btn-sm mb-5">Reset</a>
        @endif

        <div class="row">
            <!-- Blog entries-->
            @forelse ($articles as $item)
                <div class="col-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                            <a href="{{ url('p/'.$item->slug) }}">
                                <img class="card-img-top post-img" src="{{ asset('storage/back/'.$item->img) }}" alt="..." />
                            </a>
                            <div class="card-body card-height">
                                <div class="small text-muted">
                                    {{ $item->created_at->format('d-m-Y') }}

                                    <a href="{{ url('category/'.$item->Category->slug) }}">{{ $item->Category->name }}</a>
                                </div>                                   
                                    <h2 class="card-title h4">{{ $item->title }}</h2>
                                <p class="card-text">{{ Str::limit(strip_tags($item->desc), 100, '...') }}</p>
                                <a class="btn btn-primary" href="{{ url('p/'.$item->slug) }}">Read more →</a>
                            </div>
                        </div>
                </div>
            @empty
            <h3>NOT FOUND</h3>
            @endforelse
        </div>
        {{ $articles->links() }}
    </div>

@endsection

