@extends('layouts.app')

@section('title', trans('messages.home'))

@section('app')
    <header class="home" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') center / cover no-repeat">
        @include('elements.navbar')

        <div class="container">
            <div class="row py-5">
                <div class="col-md-4 offset-md-2 text-center text-uppercase d-flex align-items-center">
                    <div>
                        @if(setting('logo'))
                            <p>
                                <img src="{{ image_url(setting('logo')) }}" class="img-fluid logo mb-3" alt="Logo">
                            </p>
                        @endif
                        <p class="h5 mb-3">{{ theme_config('header_description') }}</p>

                        @if($server)
                            @if($server->joinUrl())
                                <a href="{{ $server->joinUrl() }}" class="btn btn-primary text-uppercase">
                                    {{ trans('messages.server.join') }}
                                </a>
                            @else
                                <button type="button" title="{{ trans('messages.actions.copy') }}" class="btn btn-primary copy-address text-uppercase"
                                        data-copied="{{ trans('messages.clipboard.copied') }}" data-copy-error="{{ trans('messages.clipboard.error') }}">
                                    {{ $server->fullAddress() }}
                                </button>
                            @endif
                        @endif

                        <div class="list-inline text-center social-links pt-4 mb-3">
                            @foreach(social_links() as $link)
                                <a href="{{ $link->value }}" class="list-inline-item mx-2" title="{{ $link->title }}" data-bs-toggle="tooltip" target="_blank" rel="noopener noreferrer">
                                    <i class="{{ $link->icon }} fs-2"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="news" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($posts as $id => $post)
                                <div class="carousel-item @if($id === 0) active @endif">
                                    @if($post->hasImage())
                                        <img src="{{ $post->imageUrl() }}" class="d-block w-100 rounded-3" alt="{{ $post->title }}">
                                    @else
                                        <svg viewBox="0 0 100 50" xmlns="http://www.w3.org/2000/svg" class="d-block w-100"></svg>
                                    @endif
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>
                                            <a href="{{ route('posts.show', $post) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h5>

                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">
                                            {{ format_date($post->published_at) }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#news" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#news" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
