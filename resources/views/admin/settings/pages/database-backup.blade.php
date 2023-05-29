@extends('admin.settings.setting-layout')
@section('title')
    {{ __('database_files') }}
@endsection
@section('website-settings')
    <section class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header1 d-flex justify-content-between">
                                <h3 class="card-title" style="line-height: 36px;">{{ __('database_files') }}</h3>
                                <form action="{{ route('settings.database.backup.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn bg-primary">
                                        <span class="mr-2"><i class="fas fa-database"></i></span>
                                        {{ __('backup_now') }}
                                    </button>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($backups->count() > 0)
                                            @foreach ($backups as $backup)
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <a href="{{ route('settings.database.backup.download', $backup->id) }}"
                                                            title="Download" class="btn btn-outline-primary btn-sm">
                                                            <span class="p-2"
                                                                style="font-weight: bold">{{ $backup->name }}</span>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('settings.database.backup.download', $backup->id) }}"
                                                            class="btn bg-success">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('settings.database.backup.destroy', $backup->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                class="btn bg-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    <x-admin.not-found word="{{ __('backup') }}"
                                                        route="settings.database.backup.store" method="POST" />
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if ($backups->total() > $backups->perPage())
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $backups->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <style>
        .card-header1 {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            padding: 0.75rem 1.25rem;
            position: relative;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

    </style>
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
@endsection

@section('script')
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        var oldTab = localStorage.getItem('Tab');
        if (oldTab) {
            $('#tablihome').removeClass('active');
            $('#home').removeClass('active');

            $('#tabli' + oldTab).addClass('active');
            $('#' + oldTab).addClass('active');
        }

        function Tab(id) {
            localStorage.setItem('Tab', id);
        }
    </script>
@endsection
