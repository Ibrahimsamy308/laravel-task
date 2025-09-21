@if (isset($route, $role, $module))
    <ul>
        @can($role . '-list')
            <li>
                <a href="{{ route($route . '.show', $module) }}" title="show">
                    <i class="ri-eye-line"></i>

                </a>
            </li>
        @endcan

        @can($role . '-edit')
            <li>
                <a href="{{ route($route . '.edit', $module) }}" title="edit">
                    <i class="ri-pencil-line"></i>
                </a>
            </li>
        @endcan

        @can($role . '-delete')
            @csrf
            @method('delete')
            <a type="button" class="btn btn-sm btn-clean btn-icon m-1" title="{{ __('general.delete') }}" data-toggle="modal"
                data-target="#deleteModalSizeSm-{{ $module->id }}">
                <i class="ri-delete-bin-line"></i>
            </a>
            <!-- Modal Start -->
            <div class="modal fade" id="deleteModalSizeSm-{{ $module->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ __('general.delete_item') }}</h5>
                            <p>{{ __('general.delete_message') }}</p>
                            @if ($module->name)
                                {{ $module->name }}
                            @elseif($module->title)
                                {!! $module->title !!}
                            @else
                                {{ $module->email }}
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="button-box text-start">
                                <button type="button" class="btn btn--no"
                                    data-dismiss="modal">{{ __('general.cancel') }}</button>
                                    <form id="delete-form-{{ $module->id }}" style="display: inline-table;"
                                        action="{{ route($route . '.destroy', $module->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                        class="btn  btn--yes btn-primary">{{ __('general.delete') }}</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End -->
        @endcan
        @can($role . '-reply')
            <a href="{{ route($route . '.reply', $module->id) }}" title="reply">
                <i class="fas fa-reply text-secondary  fa-lg"></i>
            </a>
        @endcan
    </ul>

@endif
@push('scripts')
    <script>
        $(document).ready(function() {
            // Move all modals with the 'modal fade' class outside of their parent td elements
            $('td').has('.modal.fade').each(function() {
                $(this).find('.modal.fade').appendTo('body');
            });
        });
    </script>
@endpush
{{-- toodle delete --}}
