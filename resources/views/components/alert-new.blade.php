@vite("resources/css/app.css")

@if (session("alert_type"))
    @php
        $alertType = session("alert_type");
        $alertTitle = session("alert_title", "");
        $alertMessage = session("alert_message", "");

        $alertStyles = [
            "success" => [
                "container" => "alert-modern alert-success-modern",
                "icon_bg" => "bg-green-500",
                "title_color" => "text-green-800",
                "message_color" => "text-green-700",
                "button_color" => "text-green-400 hover:text-green-600",
                "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
            ],
            "error" => [
                "container" => "alert-modern alert-error-modern",
                "icon_bg" => "bg-red-500",
                "title_color" => "text-red-800",
                "message_color" => "text-red-700",
                "button_color" => "text-red-400 hover:text-red-600",
                "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
            ],
            "warning" => [
                "container" => "alert-modern alert-warning-modern",
                "icon_bg" => "bg-yellow-500",
                "title_color" => "text-yellow-800",
                "message_color" => "text-yellow-700",
                "button_color" => "text-yellow-400 hover:text-yellow-600",
                "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
            ],
            "info" => [
                "container" => "alert-modern alert-info-modern",
                "icon_bg" => "bg-blue-500",
                "title_color" => "text-blue-800",
                "message_color" => "text-blue-700",
                "button_color" => "text-blue-400 hover:text-blue-600",
                "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
            ],
        ];

        $style = $alertStyles[$alertType] ?? $alertStyles["info"];
    @endphp

    <div
        id="alert-{{ $alertType }}"
        role="alert"
        class="{{ $style["container"] }} fixed top-6 right-6 z-[9999] max-w-96 min-w-80"
    >
        <div class="flex items-center p-4">
            <div class="flex-shrink-0">
                <div
                    class="{{ $style["icon_bg"] }} flex h-8 w-8 items-center justify-center rounded-full shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        {!! $style["icon"] !!}
                    </svg>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <p class="{{ $style["title_color"] }} text-sm font-semibold">
                    {{ $alertTitle }}
                </p>
                <p class="{{ $style["message_color"] }} text-sm">
                    {{ $alertMessage }}
                </p>
            </div>
            <button
                type="button"
                class="{{ $style["button_color"] }} ml-4 flex-shrink-0 transition-colors duration-200"
                onclick="closeAlert('alert-{{ $alertType }}')"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>
@endif

<script>
    function closeAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            alertElement.style.opacity = '0';
            alertElement.style.transform = 'translateX(100%)';
            alertElement.style.transition =
                'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                if (alertElement.parentNode) {
                    alertElement.remove();
                }
            }, 300);
        }
    }

    // Auto-close after 7 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.alert-modern');

        alerts.forEach((alert) => {
            // Show animation
            setTimeout(() => {
                alert.style.opacity = '1';
                alert.style.transform = 'translateX(0)';
                alert.style.transition =
                    'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            }, 100);

            // Auto close after 7 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    closeAlert(alert.id);
                }
            }, 7000);
        });
    });
</script>

<style>
    .alert-modern {
        background: white;
        border-radius: 12px;
        box-shadow:
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(8px);
        opacity: 0;
        transform: translateX(100%);
    }

    .alert-success-modern {
        border-left: 4px solid #10b981;
    }

    .alert-error-modern {
        border-left: 4px solid #ef4444;
    }

    .alert-warning-modern {
        border-left: 4px solid #f59e0b;
    }

    .alert-info-modern {
        border-left: 4px solid #3b82f6;
    }
</style>
