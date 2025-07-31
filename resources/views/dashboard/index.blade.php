@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')
    <div class="lg:ml-64">
        <div class="p-6 pt-20 lg:pt-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Total Instance</p>
                            <h3 class="text-2xl font-bold">{{ $instance }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            {{-- <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                    <a href="#" class="text-blue-600 hover:underline">View All</a>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="font-medium">New user registered</p>
                            <p class="text-gray-500 text-sm">John Doe registered 2 hours ago</p>
                        </div>
                        <span class="ml-auto text-sm text-gray-500">2h ago</span>
                    </div>

                    <div class="flex items-start">
                        <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div>
                            <p class="font-medium">New order received</p>
                            <p class="text-gray-500 text-sm">Order #1234 for $125.00</p>
                        </div>
                        <span class="ml-auto text-sm text-gray-500">5h ago</span>
                    </div>

                    <div class="flex items-start">
                        <div class="p-2 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <p class="font-medium">New support ticket</p>
                            <p class="text-gray-500 text-sm">Ticket #5678 from Sarah</p>
                        </div>
                        <span class="ml-auto text-sm text-gray-500">1d ago</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        console.log('Dashboard loaded')
    </script>
@endpush
