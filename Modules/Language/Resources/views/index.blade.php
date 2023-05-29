@extends('admin.settings.setting-layout')

@section('title')
    {{ __('language_list') }}
@endsection

@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('setDefaultLanguage') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <x-forms.label name="set_default_language" for="inlineFormCustomSelect" class="mr-sm-2" />
                            <select name="code" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value="" hidden>{{ __('language') }}</option>
                                @foreach ($languages as $language)
                                    <option {{ $language->code == env('APP_DEFAULT_LANGUAGE') ? 'selected' : '' }}
                                        value="{{ $language->code }}">
                                        {{ $language->name }}({{ $language->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-2 py-2 ">
                            <button type="submit" class="btn btn-primary "
                                style="margin-top:25px">{{ __('save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('language_list') }}</h3>
                        <a href="{{ route('language.create') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-plus"></i>
                            &nbsp;
                            {{ __('add_language') }}
                        </a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('direction') }}</th>
                                    <th>{{ __('flag') }}</th>
                                    <th width="15%">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languages as $key => $language)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $language->name }}
                                            @if (env('APP_DEFAULT_LANGUAGE') == $language->code)
                                                <span class="badge badge-pill badge-primary">{{ __('default') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $language->code }}</td>
                                        <td>{{ $language->direction }}</td>
                                        <td><i class="flag-icon {{ $language->icon }}"></i></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('language.view', $language->code) }}"
                                                class="btn btn-secondary mr-2"><i class="fas fa-cog"></i></a>
                                            @if ($language->code == 'en')
                                                <a href="javascript:void(0)" class="btn btn-warning mt-0 mr-2"
                                                    data-toggle="tooltip" title="You can't delete or edit this language">
                                                    <i class="fas fa-lock"></i>
                                                </a>
                                            @endif
                                            @if ($language->code != 'en')
                                                <a href="{{ route('language.edit', $language->id) }}"
                                                    class="btn btn-info mt-0 mr-2"><i class="fas fa-edit"></i></a>
                                                @if ($language->code !== 'en')
                                                    <form action="{{ route('language.delete', $language->id) }}"
                                                        class="d-inline" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_language') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item?') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            @if (userCan('setting.update'))
                                                <x-admin.not-found word="{{ __('language') }}" route="language.create" />
                                            @else
                                                <x-admin.not-found word="{{ __('language') }}" route="" />
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
