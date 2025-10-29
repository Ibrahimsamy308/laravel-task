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
        {{-- <script>
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
        </script> --}}

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let input = document.getElementById("{{ $id }}_input");
                let filenameSpan = document.getElementById("{{ $id }}_filename");
            
                // إنشاء toast container مرة واحدة
                let toastContainer = document.getElementById("upload-toast-container");
                if (!toastContainer) {
                    toastContainer = document.createElement("div");
                    toastContainer.id = "upload-toast-container";
                    toastContainer.style.position = "fixed";
                    toastContainer.style.top = "20px";
                    toastContainer.style.right = "20px";
                    toastContainer.style.zIndex = "9999";
                    document.body.appendChild(toastContainer);
                }
            
                function showToast(message, percent = null, type = "info") {
                    let toast = document.getElementById("upload-toast");
                    if (!toast) {
                        toast = document.createElement("div");
                        toast.id = "upload-toast";
                        toast.style.minWidth = "300px";
                        toast.style.padding = "15px 20px";
                        toast.style.marginTop = "10px";
                        toast.style.borderRadius = "10px";
                        toast.style.color = "#fff";
                        toast.style.fontWeight = "bold";
                        toast.style.boxShadow = "0 3px 10px rgba(0,0,0,0.2)";
                        toast.style.overflow = "hidden";
                        toastContainer.appendChild(toast);
                    }
            
                    // الألوان حسب الحالة
                    let bgColor, progressColor;
                    if (type === "info") {
                        bgColor = "#007bff";
                        progressColor = "#00c3ff";
                    } else if (type === "success") {
                        bgColor = "#28a745";
                        progressColor = "#5efc82";
                    } else if (type === "error") {
                        bgColor = "#dc3545";
                        progressColor = "#ff6f6f";
                    }
            
                    toast.style.background = `linear-gradient(90deg, ${bgColor}, ${progressColor})`;
            
                    toast.innerHTML = `
                        <div style="margin-bottom:8px;">${message}</div>
                        <div style="position:relative; background:#ffffff33; border-radius:6px; height:10px; width:100%;">
                            <div id="upload-progress-bar" style="width:${percent || 0}%; background:#fff; height:100%; border-radius:6px; transition:width 0.4s;"></div>
                            <span id="upload-percent-text" style="position:absolute; top:-25px; right:0; font-size:13px; color:#fff; font-weight:bold;">
                                ${percent !== null ? percent + "%" : ""}
                            </span>
                        </div>
                    `;
                }
            
                function hideToast(delay = 2000) {
                    let toast = document.getElementById("upload-toast");
                    if (toast) {
                        setTimeout(() => {
                            toast.style.opacity = "0";
                            setTimeout(() => toast.remove(), 400);
                        }, delay);
                    }
                }
            
                if (input) {
                    input.addEventListener("change", function () {
                        if (this.files && this.files.length > 0) {
                            filenameSpan.textContent = this.files[0].name;
            
                            let percent = 0;
                            showToast("جاري رفع الفيديو...", percent, "info");
            
                            let interval = setInterval(() => {
                                percent += 10;
                                if (percent >= 100) {
                                    percent = 100;
                                    clearInterval(interval);
                                    showToast("تم رفع الفيديو بنجاح ✅", 100, "success");
                                    hideToast(3000);
                                } else {
                                    showToast("جاري رفع الفيديو...", percent, "info");
                                }
                            }, 400);
                        } else {
                            filenameSpan.textContent = "";
                            showToast("تم إلغاء الرفع ❌", null, "error");
                            hideToast(2000);
                        }
                    });
                }
            });
        </script>
            
    @endpush
@endif
