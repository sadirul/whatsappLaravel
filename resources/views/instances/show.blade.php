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
                        <p class="text-gray-600 mt-2"><strong>API Key:</strong> <span
                                class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $instance->api_key }}</span></p>
                        <p class="text-gray-600 mt-2"><strong>Created At:</strong>
                            {{ $instance->created_at->format('d M, Y h:i A') }}</p>
                    </div>

                    <!-- QR Code Placeholder -->
                    <div id="qr-box"
                        class="flex flex-col items-center justify-center border border-dashed border-gray-300 rounded p-6 bg-gray-50 space-y-4">
                        <p class="text-gray-400">QR Code will be displayed here dynamically via API.</p>
                        <button id="logout-btn"
                            class="hidden bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                            🔌 Logout from WhatsApp
                        </button>
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
        $(document).ready(function() {
            const instanceKey = @json($instance->api_key)

            // Start session
            $.get(`/api/whatsapp/start-session?instanceKey=${instanceKey}`, function(startData) {
                console.log('Start Session:', startData)
                fetchQR()
            }).fail(function(err) {
                console.error('Start session error', err)
            })

            // Fetch QR Code or Connection Status
            function fetchQR() {
                $.get(`/api/whatsapp/get-qr?instanceKey=${instanceKey}`, function(qrData) {
                    console.log('QR Response:', qrData)

                    if (qrData.connected) {
                        $('#qr-box').html(`
                        <p class="text-green-600 font-semibold mb-2">✅ Already connected to WhatsApp</p>
                        <button id="logout-btn" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                            🔌 Logout from WhatsApp
                        </button>
                    `)
                        bindLogoutEvent()
                    } else if (qrData.success && qrData.qr) {
                        $('#qr-box').html(`
                        <img src="${qrData.qr}" alt="QR Code" class="w-48 h-48" />
                    `)
                        setTimeout(fetchQR, (qrData.expiresIn || 10) * 1000)
                    } else {
                        $('#qr-box').html(
                            `<p class="text-red-600 font-semibold">❌ QR expired or not available. Please refresh to retry.</p>`
                            )
                    }
                }).fail(function(err) {
                    console.error('QR fetch error', err)
                    $('#qr-box').html(
                        `<p class="text-red-600 font-semibold">❌ Failed to load QR code. Try again later.</p>`
                        )
                })
            }

            // Logout handler
            function bindLogoutEvent() {
                $('#logout-btn').on('click', function() {
                    $(this).prop('disabled', true).text('Logging out...')
                    $.get(`/api/whatsapp/logout?instanceKey=${instanceKey}`, function(res) {
                        if (res.status == 'success') {
                            location.reload()
                        } else {
                            alert('Failed to logout. Please try again.')
                            $('#logout-btn').prop('disabled', false).text('🔌 Logout from WhatsApp')
                        }
                    }).fail(function() {
                        alert('Logout failed due to server error.')
                        $('#logout-btn').prop('disabled', false).text('🔌 Logout from WhatsApp')
                    })
                })
            }
        })
    </script>
@endpush
