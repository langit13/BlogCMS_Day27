@extends('front.layout.template')

@section('title', 'Nebula Blog')

@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="{{ url('p/'.$latest_post->slug) }}">
                        <img class="card-img-top featured-img" src="{{ asset('storage/back/'.$latest_post->img) }}" alt="..." />
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $latest_post->created_at->format('d-m-Y') }}</div>
                        <h2 class="card-title">{{ $latest_post->title }}</h2>
                        <p class="card-text">{{ Str::limit(strip_tags($latest_post->desc), 100, '...') }}</p>
                        <a class="btn btn-primary" href="{{ url('p/'.$latest_post->slug) }}">Read more →</a>
                    </div>
                </div>
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    @foreach ($articles as $item)
                        <div class="col-lg-6">
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
                    @endforeach

                </div>

                <div class="pagination justify-content-center my-4">
                    {{ $articles->links() }}
                </div>
            </div>
            <!-- Side widgets-->
            @include('front.layout.sidewidget')
        </div>
    </div>

@endsection

