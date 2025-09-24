@vite('resources/css/app.css')


@if(session('success'))
<div id="alert-success" role="alert" class="alert-modern alert-success-modern fixed top-6 right-6 z-[9999] min-w-80 max-w-96">
    <div class="flex items-center p-4">
        <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm font-semibold text-green-800">สำเร็จ!</p>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
        <button type="button" class="flex-shrink-0 ml-4 text-green-400 hover:text-green-600 transition-colors duration-200" onclick="closeAlert('alert-success')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div id="alert-error" role="alert" class="alert-modern alert-error-modern fixed top-6 right-6 z-[9999] min-w-80 max-w-96">
    <div class="flex items-center p-4">
        <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm font-semibold text-red-800">เกิดข้อผิดพลาด!</p>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
        <button type="button" class="flex-shrink-0 ml-4 text-red-400 hover:text-red-600 transition-colors duration-200" onclick="closeAlert('alert-error')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

@if(session('warning'))
<div id="alert-warning" role="alert" class="alert-modern alert-warning-modern fixed top-6 right-6 z-[9999] min-w-80 max-w-96">
    <div class="flex items-center p-4">
        <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm font-semibold text-yellow-800">คำเตือน!</p>
            <p class="text-sm text-yellow-700">{{ session('warning') }}</p>
        </div>
        <button type="button" class="flex-shrink-0 ml-4 text-yellow-400 hover:text-yellow-600 transition-colors duration-200" onclick="closeAlert('alert-warning')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

@if(session('info'))
<div id="alert-info" role="alert" class="alert-modern alert-info-modern fixed top-6 right-6 z-[9999] min-w-80 max-w-96">
    <div class="flex items-center p-4">
        <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm font-semibold text-blue-800">ข้อมูล</p>
            <p class="text-sm text-blue-700">{{ session('info') }}</p>
        </div>
        <button type="button" class="flex-shrink-0 ml-4 text-blue-400 hover:text-blue-600 transition-colors duration-200" onclick="closeAlert('alert-info')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

<script>
function closeAlert(alertId) {
    const alertElement = document.getElementById(alertId);
    if (alertElement) {
        // Add exit animation
        alertElement.style.animation = 'slideOutRight 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards';

        // Remove element after animation
        setTimeout(() => {
            if (alertElement.parentNode) {
                alertElement.remove();
                // Reposition other alerts
                repositionAlerts();
            }
        }, 400);
    }
}

function repositionAlerts() {
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach((alert, index) => {
        alert.style.top = `${1.5 + (index * 4)}rem`;
        alert.style.transition = 'top 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    });
}

// Enhanced auto-close with progress indicator
function createProgressBar(alertElement, duration = 5000) {
    const progressBar = document.createElement('div');
    progressBar.className = 'alert-progress-bar';
    progressBar.style.cssText = `
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        background: linear-gradient(90deg, rgba(255,255,255,0.8), rgba(255,255,255,0.4));
        border-radius: 0 0 0 16px;
        animation: progressBarAnimation ${duration}ms linear forwards;
        z-index: 10;
    `;

    // Add progress bar animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes progressBarAnimation {
            from { width: 100%; }
            to { width: 0%; }
        }
    `;
    document.head.appendChild(style);

    alertElement.appendChild(progressBar);

    // Auto close after duration
    setTimeout(() => {
        if (alertElement.parentNode) {
            closeAlert(alertElement.id);
        }
    }, duration);
}

// Sound effects (optional)
function playNotificationSound(type) {
    if ('AudioContext' in window || 'webkitAudioContext' in window) {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();

        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);

        // Different frequencies for different alert types
        const frequencies = {
            success: 800,
            error: 400,
            warning: 600,
            info: 500
        };

        oscillator.frequency.setValueAtTime(frequencies[type] || 500, audioContext.currentTime);
        oscillator.type = 'sine';

        gainNode.gain.setValueAtTime(0, audioContext.currentTime);
        gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
        gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + 0.3);

        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.3);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-modern');

    alerts.forEach((alert, index) => {
        // Position alerts with staggered animation
        setTimeout(() => {
            alert.style.opacity = '1';
            alert.style.transform = 'translateX(0)';
        }, index * 100);

        // Add progress bar and auto-close
        createProgressBar(alert, 7000); // 7 seconds

        // Play notification sound based on alert type
        if (alert.classList.contains('alert-success-modern')) {
            playNotificationSound('success');
        } else if (alert.classList.contains('alert-error-modern')) {
            playNotificationSound('error');
        } else if (alert.classList.contains('alert-warning-modern')) {
            playNotificationSound('warning');
        } else if (alert.classList.contains('alert-info-modern')) {
            playNotificationSound('info');
        }

        // Add swipe to dismiss on touch devices
        let startX = 0;
        let currentX = 0;
        let isDragging = false;

        alert.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
            alert.style.transition = 'none';
        });

        alert.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
            const deltaX = currentX - startX;

            if (deltaX > 0) { // Only allow swipe right
                alert.style.transform = `translateX(${deltaX}px)`;
                alert.style.opacity = Math.max(0.3, 1 - deltaX / 200);
            }
        });

        alert.addEventListener('touchend', function() {
            if (!isDragging) return;
            isDragging = false;

            const deltaX = currentX - startX;
            alert.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';

            if (deltaX > 100) { // Threshold for dismissal
                closeAlert(alert.id);
            } else {
                // Snap back
                alert.style.transform = 'translateX(0)';
                alert.style.opacity = '1';
            }
        });
    });

    repositionAlerts();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const alerts = document.querySelectorAll('.alert-modern');
        if (alerts.length > 0) {
            closeAlert(alerts[alerts.length - 1].id);
        }
    }
});
</script>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

@import "tailwindcss";
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';

@plugin "daisyui";

@theme {
    --font-prompt: "Prompt", san-serif;
}

@keyframes slide {
  0%, 20% {
    transform: translateX(0%);
  }
  33%, 53% {
    transform: translateX(-33.3333%);
  }
  66%, 86% {
    transform: translateX(-66.6666%);
  }
  100% {
    transform: translateX(0%);
  }
}

.animate-slide {
  animation: slide 12s infinite;
}

@keyframes indicator {
  0%, 33%   { width: 2rem; background-color: rgb(19, 111, 248); }
  34%, 100% { width: 1.5rem; background-color: rgb(255, 255, 255); }
}

.animate-indicator1 {
  animation: indicator 12s infinite;
}
.animate-indicator2 {
  animation: indicator 12s infinite;
  animation-delay: 4s;
}
.animate-indicator3 {
  animation: indicator 12s infinite;
  animation-delay: 8s;
}

.btn{
    padding-block: 5px;
    padding-inline: 30px;
    border-radius: 10px;
    cursor: pointer;
}


progress.progress {
  -webkit-appearance: none;
  appearance: none;
  overflow: hidden;
  border-radius: 9999px;
}


progress.progress::-webkit-progress-bar {
  background-color: #e5e7eb;
  border-radius: 9999px;
}

progress.progress::-webkit-progress-value {
  background-color: #41ea47;
  border-radius: 9999px;
  transition: width 0.3s ease;
}

progress.progress::-moz-progress-bar {
  background-color: #41ea47;
  border-radius: 9999px;
  transition: width 0.3s ease;
}

</style>
