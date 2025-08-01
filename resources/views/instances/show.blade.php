@extends('layouts.app')

@section('title', 'View WhatsApp Instance')

@section('content')
    <div class="lg:ml-64">
        <div class="p-6 pt-20 lg:pt-6">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">WhatsApp Instance Details</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Instance Info -->
                    <div>
                        <p class="text-gray-600"><strong>Instance Name:</strong> {{ $instance->instance_name }}</p>
                        <div class="text-gray-600 mt-2 flex items-center">
                            <strong>API Key:</strong> 
                            <span class="text-sm bg-gray-100 px-2 py-1 rounded ml-2" id="api-key-display">
                                {{ substr($instance->api_key, 0, 3) . str_repeat('*', strlen($instance->api_key) - 6) . substr($instance->api_key, -3) }}
                            </span>
                            <button 
                                onclick="copyToClipboard('{{ $instance->api_key }}')" 
                                class="ml-2 text-blue-600 hover:text-blue-800"
                                title="Copy to clipboard"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 mt-2"><strong>Created At:</strong>
                            {{ $instance->created_at->format('d M, Y h:i A') }}</p>

                        <p class="text-gray-600 mt-2"> <span class="text-sm bg-gray-100 px-2 py-1 rounded"><a target="_blank"
                                    href="{{ route('doc', ['api-key' => $instance->api_key]) }}">View
                                    Documentation</a></span></p>
                        
                        <!-- Connection Status -->
                        <div class="mt-4">
                            <p class="text-gray-600"><strong>Status:</strong> 
                                <span id="connection-status" class="px-2 py-1 rounded text-sm">
                                    <span class="text-yellow-600">🔄 Checking...</span>
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- QR Code Placeholder -->
                    <div id="qr-box"
                        class="flex flex-col items-center justify-center border border-dashed border-gray-300 rounded p-6 bg-gray-50 space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                            <p class="text-gray-400">Initializing WhatsApp session...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructional GIF -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">How to Scan WhatsApp QR Code</h3>
                <p class="text-gray-600 mb-4">Use the WhatsApp app to scan the QR code shown above. Open WhatsApp, go to
                    settings > Linked Devices > Link a device.</p>
                <div class="flex justify-center">
                    <img src="https://food.sadirul.in/assets/whatsapp/scan-demo.gif" alt="Scan WhatsApp QR Code"
                        class="rounded-lg border shadow-lg max-w-full w-full md:w-2/3" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show tooltip or notification
                const tooltip = document.createElement('div');
                tooltip.className = 'fixed top-10 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg';
                tooltip.textContent = 'Copied to clipboard!';
                document.body.appendChild(tooltip);
                
                setTimeout(() => {
                    document.body.removeChild(tooltip);
                }, 2000);
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }

        $(document).ready(function() {
            const instanceKey = @json($instance->api_key);
            let qrCheckInterval;
            let connectionCheckInterval;

            console.log('🚀 Initializing WhatsApp instance:', instanceKey);

            // Start the session initialization
            initializeSession();

            function initializeSession() {
                updateStatus('🔄 Starting session...', 'text-yellow-600');
                
                $.get(`/api/whatsapp/start-session?instanceKey=${instanceKey}`)
                    .done(function(response) {
                        console.log('✅ Start Session Response:', response);
                        
                        if (response.success) {
                            if (response.connected) {
                                showConnectedState();
                            } else {
                                updateStatus('📱 Session started, waiting for QR...', 'text-blue-600');
                                startQRPolling();
                            }
                        } else {
                            showError('Failed to start session: ' + (response.message || 'Unknown error'));
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.error('❌ Start session failed:', xhr.responseText);
                        showError('Failed to start session. Please try refreshing the page.');
                    });
            }

            function startQRPolling() {
                // Clear any existing interval
                if (qrCheckInterval) clearInterval(qrCheckInterval);
                
                // Start polling for QR code
                fetchQRCode();
                qrCheckInterval = setInterval(fetchQRCode, 3000); // Check every 3 seconds
            }

            function fetchQRCode() {
                $.get(`/api/whatsapp/get-qr?instanceKey=${instanceKey}`)
                    .done(function(response) {
                        console.log('📱 QR Response:', response);

                        if (response.success) {
                            if (response.connected) {
                                clearInterval(qrCheckInterval);
                                showConnectedState();
                            } else if (response.qr) {
                                showQRCode(response.qr, response.expiresIn);
                                updateStatus('📱 QR Code ready - Scan to connect', 'text-blue-600');
                            }
                        } else {
                            if (response.needsRestart) {
                                showRestartButton(response.message);
                            } else {
                                showError(response.message || 'Failed to get QR code');
                            }
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.error('❌ QR fetch failed:', xhr.responseText);
                        showError('Failed to fetch QR code. Connection issue.');
                    });
            }

            function showQRCode(qrData, expiresIn) {
                $('#qr-box').html(`
                    <div class="text-center space-y-4">
                        <img src="${qrData}" alt="WhatsApp QR Code" class="w-48 h-48 mx-auto border rounded-lg" />
                        <div class="text-sm text-gray-500">
                            <p>⏰ QR expires in: <span id="countdown">${expiresIn || 60}</span> seconds</p>
                            <p class="mt-2">📱 Open WhatsApp → Settings → Linked Devices → Link a device</p>
                        </div>
                    </div>
                `);

                // Start countdown
                startCountdown(expiresIn || 60);
            }

            function startCountdown(seconds) {
                const countdownElement = $('#countdown');
                let remaining = seconds;

                const countdown = setInterval(() => {
                    remaining--;
                    countdownElement.text(remaining);

                    if (remaining <= 0) {
                        clearInterval(countdown);
                        countdownElement.parent().html('<p class="text-red-500">⏰ QR Code expired</p>');
                    }
                }, 1000);
            }

            function showConnectedState() {
                clearInterval(qrCheckInterval);
                updateStatus('✅ Connected to WhatsApp', 'text-green-600');
                
                $('#qr-box').html(`
                    <div class="text-center space-y-4">
                        <div class="text-green-600 text-6xl">✅</div>
                        <p class="text-green-600 font-semibold text-lg">Connected to WhatsApp!</p>
                        <p class="text-gray-500 text-sm">Your WhatsApp instance is ready to send messages</p>
                        <button id="logout-btn" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                            🔌 Logout from WhatsApp
                        </button>
                    </div>
                `);
                
                bindLogoutEvent();
                startConnectionMonitoring();
            }

            function showError(message) {
                updateStatus('❌ Error', 'text-red-600');
                $('#qr-box').html(`
                    <div class="text-center space-y-4">
                        <div class="text-red-500 text-4xl">❌</div>
                        <p class="text-red-600 font-semibold">${message}</p>
                        <button id="retry-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                            🔄 Retry Connection
                        </button>
                    </div>
                `);

                $('#retry-btn').on('click', function() {
                    location.reload();
                });
            }

            function showRestartButton(message) {
                updateStatus('⚠️ Session needs restart', 'text-yellow-600');
                $('#qr-box').html(`
                    <div class="text-center space-y-4">
                        <div class="text-yellow-500 text-4xl">⚠️</div>
                        <p class="text-yellow-600 font-semibold">${message}</p>
                        <button id="restart-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                            🔄 Restart Session
                        </button>
                    </div>
                `);

                $('#restart-btn').on('click', function() {
                    $(this).prop('disabled', true).html('🔄 Restarting...');
                    initializeSession();
                });
            }

            function updateStatus(text, colorClass) {
                $('#connection-status').html(`<span class="${colorClass}">${text}</span>`);
            }

            function startConnectionMonitoring() {
                // Check connection status every 30 seconds
                connectionCheckInterval = setInterval(function() {
                    $.get(`/api/whatsapp/status?instanceKey=${instanceKey}`)
                        .done(function(response) {
                            if (response.success && !response.connected) {
                                // Connection lost, restart session
                                console.log('🔌 Connection lost, restarting...');
                                clearInterval(connectionCheckInterval);
                                location.reload();
                            }
                        })
                        .fail(function() {
                            console.log('⚠️ Status check failed');
                        });
                }, 30000);
            }

            function bindLogoutEvent() {
                $('#logout-btn').on('click', function() {
                    const button = $(this);
                    button.prop('disabled', true).html('🔄 Logging out...');
                    
                    $.get(`/api/whatsapp/logout?instanceKey=${instanceKey}`)
                        .done(function(response) {
                            console.log('🔌 Logout response:', response);
                            
                            if (response.status === 'success') {
                                updateStatus('🔌 Logged out successfully', 'text-gray-600');
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            } else {
                                alert('Failed to logout: ' + (response.message || 'Unknown error'));
                                button.prop('disabled', false).html('🔌 Logout from WhatsApp');
                            }
                        })
                        .fail(function(xhr) {
                            console.error('❌ Logout failed:', xhr.responseText);
                            alert('Logout failed due to server error.');
                            button.prop('disabled', false).html('🔌 Logout from WhatsApp');
                        });
                });
            }

            // Cleanup intervals when page is unloaded
            $(window).on('beforeunload', function() {
                if (qrCheckInterval) clearInterval(qrCheckInterval);
                if (connectionCheckInterval) clearInterval(connectionCheckInterval);
            });
        });
    </script>
@endpush