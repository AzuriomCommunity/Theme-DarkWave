@extends('layouts.base')

@section('app')
    <header class="top-header" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') center / cover no-repeat">
        @include('elements.navbar')

        <div class="container header-content">
            <div class="row py-5">
                <div class="col-md-4 offset-md-2 text-center">
                    @if(setting('logo'))
                        <img src="{{ image_url(setting('logo')) }}" class="img-fluid logo mb-3" alt="Logo">
                    @endif
                </div>
                <div class="col-md-4 text-center text-uppercase">
                    <p class="h5 mb-3">{{ theme_config('header_description') }}</p>

                    @if($server)
                        @if($server->joinUrl())
                            <a href="{{ $server->joinUrl() }}" class="btn btn-primary text-uppercase">
                                {{ trans('messages.server.join') }}
                            </a>
                        @else
                            <button type="button" title="{{ trans('messages.actions.copy') }}" class="btn btn-primary text-uppercase copy-address"
                                    data-copied="{{ trans('messages.clipboard.copied') }}" data-copy-error="{{ trans('messages.clipboard.error') }}">
                                {{ $server->fullAddress() }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>
            <div class="text-center text-uppercase pb-1">
                @if($server->isOnline())
                    <p class="h5">{{ trans_choice('messages.server.online', $server->getOnlinePlayers()) }}</p>
                @else
                    <p class="h5">{{ trans('messages.server.offline') }}</p>
                @endif
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            @include('elements.session-alerts')
        </div>

        <div class="container content">
            @yield('content')
        </div>
    </main>
@endsection
