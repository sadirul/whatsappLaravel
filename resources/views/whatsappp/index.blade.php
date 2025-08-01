@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="lg:ml-64">
        <div class="p-6 pt-20 lg:pt-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

            <!-- New Instance Button -->
            <button onclick="document.getElementById('instanceModal').classList.remove('hidden')"
                class="mb-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                New WhatsApp Instance
            </button>

            <!-- Modal -->
            <div id="instanceModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h2 class="text-xl font-bold mb-4">Create WhatsApp Instance</h2>
                    <form id="instanceForm">
                        @csrf
                        <input type="text" name="instance_name" placeholder="Instance Name"
                            class="w-full p-2 border rounded mb-4" required />
                        <div class="flex justify-end">
                            <button type="button"
                                onclick="document.getElementById('instanceModal').classList.add('hidden')"
                                class="mr-2 text-gray-600 hover:text-gray-800">Cancel</button>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
                        </div>
                    </form>
                </div>
            </div>




            <!-- Instance List -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Your WhatsApp Instances</h2>
                </div>

                @if ($instances->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-sm uppercase text-left">
                                    <th class="p-3">#</th>
                                    <th class="p-3">Instance Name</th>
                                    <th class="p-3">API Key</th>
                                    <th class="p-3">Created At</th>
                                    <th class="p-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach ($instances as $index => $instance)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3">{{ $index + 1 }}</td>
                                        <td class="p-3">{{ $instance->instance_name }}</td>
                                        <td class="p-3">
                                            {{ substr($instance->api_key, 0, 3) . str_repeat('*', strlen($instance->api_key) - 6) . substr($instance->api_key, -3) }}
                                        </td>
                                        <td class="p-3">{{ $instance->created_at->diffForHumans() }}</td>
                                        <td class="p-3 text-center">
                                            <a href="{{ route('whatsapp.instance.show', $instance->id) }}"
                                                class="text-blue-600 hover:text-blue-800" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No instances found.</p>
                @endif
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function Notification(message) {
                // Show tooltip or notification
                const tooltip = document.createElement('div');
                tooltip.className = 'fixed top-10 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg';
                tooltip.textContent = message;
                document.body.appendChild(tooltip);

                setTimeout(() => {
                    document.body.removeChild(tooltip);
                }, 2000);

            }


            document.getElementById('instanceForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                const response = await fetch("{{ route('whatsapp.instance.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form._token.value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();
                if (data.status === 'success') {
                    Notification(data.message);
                    form.reset();
                    document.getElementById('instanceModal').classList.add('hidden');
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);

                } else {
                    alert('Failed to create instance');
                }
            });
        </script>
    @endpush
@endsection
