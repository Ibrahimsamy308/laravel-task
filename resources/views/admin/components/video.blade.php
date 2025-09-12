@if ($name && $label && $id)
    <div>
        <div class="mb-4 row align-items-center">
            <label class="form-label-title col-sm-3 mb-0">{{ $label }}
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
            <div class="col-sm-9">
                <div class="video-input" id="{{ $id }}">
                    {{-- لو فيه فيديو محفوظ --}}
                    @if (!empty($value))
                        <video width="320" height="240" controls>
                            <source src="{{ $value }}" type="video/mp4">
                            متصفحك لا يدعم تشغيل الفيديو.
                        </video>
                    @endif

                    <label class="btn btn-sm btn-primary mt-2">
                        <i class="fa fa-upload"></i> {{ __('general.choose_file') }}
                        <input type="file" name="{{ $name }}" id="{{ $id }}_input"
                               accept="{{ $accept ?? 'video/*' }}" hidden
                               @if ($required && empty($value)) required @endif>
                    </label>

                    {{-- هنا هيظهر اسم الفيديو --}}
                    <span id="{{ $id }}_filename" class="ms-2 text-muted"></span>
                </div>
            </div>
        </div>

        @isset($deleteVideo)
            @include('admin.components.deleteVideo')
        @endisset
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let input = document.getElementById("{{ $id }}_input");
                let filenameSpan = document.getElementById("{{ $id }}_filename");

                if (input) {
                    input.addEventListener("change", function () {
                        if (this.files && this.files.length > 0) {
                            filenameSpan.textContent = this.files[0].name;
                        } else {
                            filenameSpan.textContent = "";
                        }
                    });
                }
            });
        </script>
    @endpush
@endif
