<table class="table table-hover text-nowrap table-bordered m-0">
    <thead>
        <tr class="text-center">
            <th>{{ __('name') }}</th>
            <th width="10%">{{ __('actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($values as $item)
            <tr data-id="{{ $item->id }}">
                <td class="text-center">
                    <a href="{{ route('module.custom.field.edit.value', $item->id) }}">
                        {{ ucfirst($item->value) }}
                    </a>
                </td>
                <td class="text-center">
                    @if (userCan('custom-field.update'))
                        <a data-toggle="tooltip" title="{{ __('edit') }}"
                            href="{{ route('module.custom.field.edit.value', $item->id) }}" class="">
                            <div class="handle btn btn-success mt-0">
                                <i class="fas fa-edit"></i>
                            </div>
                        </a>
                    @endif
                    @if (userCan('custom-field.delete'))
                        <form action="{{ route('module.custom.field.destroy.value', $item->id) }}" method="POST"
                            class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button data-toggle="tooltip" data-placement="top" title="{{ __('delete') }}"
                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                class="btn bg-danger mr-1"><i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">
                    <x-not-found word="field" route="" />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
