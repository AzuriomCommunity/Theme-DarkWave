@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')

    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@include('admin.elements.editor')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                @foreach(['header_description' => ['header_description','text'],
                          'footer_description' => ['footer_description','text'],
                ] as $input)
                    <div class="mb-3">
                        @if($input[1] == 'text')
                            <label class="form-label" for="{{ $input[0] }}Input">{{ trans('theme::theme.config.'.$input[0]) }}</label>
                            <input type="text" class="form-control @error($input[0]) is-invalid @enderror" id="{{ $input[0] }}Input" name="{{ $input[0] }}" value="{{ old($input[0], theme_config($input[0])) }}">
                        @else
                            <label class="form-label" for="{{ $input[0] }}Input">{{ trans('theme::theme.config.'.$input[0]) }}</label>
                            <textarea style="min-height: 150px" class="form-control html-editor @error($input[0]) is-invalid @enderror" id="{{ $input[0] }}Input" name="{{ $input[0] }}">{{ old($input[0], theme_config($input[0])) }}</textarea>
                        @endif

                        @error($input[0])<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                @endforeach

                <label>{{ trans('theme::theme.config.footer_links') }}</label>

                <div id="links">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="row g-3">
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <button class="btn btn-outline-danger link-remove" type="button">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
