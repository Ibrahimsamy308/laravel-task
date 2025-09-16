@if ($name && $label && $id)
<div>
    <div class="mb-4 row align-items-center">
        <label class="form-label-title col-sm-3 mb-0">{{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
        <div class="col-sm-9">
            <div class="materials-input" id="{{ $id }}">
                
                {{-- لو فيه ملفات محفوظة --}}
                @if (!empty($value) && count($value) > 0)
                    <ul class="list-group mb-2">
                        @foreach ($value as $file)
                            <li class="list-group-item">
                                <a href="{{ asset($file->url ?? $file) }}" target="_blank">
                                    {{ basename($file->url ?? $file) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <label class="btn btn-sm btn-primary mt-2">
                    <i class="fa fa-upload"></i> {{ __('general.choose_files') }}
                    <input type="file" 
                           name="{{ $name }}" 
                           id="{{ $id }}_input"
                           accept="{{ $accept ?? '*' }}" 
                           multiple 
                           hidden
                           @if ($required && empty($value)) required @endif>
                </label>

                {{-- هنا هيظهر أسماء الملفات المختارة --}}
                <span id="{{ $id }}_filenames" class="ms-2 text-muted"></span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let input = document.getElementById("{{ $id }}_input");
        let filenamesSpan = document.getElementById("{{ $id }}_filenames");

        if (input) {
            input.addEventListener("change", function () {
                if (this.files && this.files.length > 0) {
                    let names = Array.from(this.files).map(f => f.name).join(', ');
                    filenamesSpan.textContent = names;
                } else {
                    filenamesSpan.textContent = "";
                }
            });
        }
    });
</script>
@endpush
@endif
