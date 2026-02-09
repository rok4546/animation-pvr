@extends('admin.layouts.base')

@section('title', 'Customers Report')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">👥 Customers Report</h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.customers') }}" style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label>Registration Start Date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label>Registration End Date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div>
                <button type="submit" class="btn">Filter</button>
                <a href="{{ route('admin.reports.customers') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    <!-- Stats Cards -->
    <div class="stats">
        <div class="stat-card">
            <h3>Total Customers</h3>
            <div class="number">{{ $total_customers }}</div>
        </div>
        <div class="stat-card">
            <h3>Customers with Orders</h3>
            <div class="number">{{ $customers_with_orders }}</div>
        </div>
        <div class="stat-card">
            <h3>Total Customer Value</h3>
            <div class="number">₹{{ number_format($total_customer_value, 2) }}</div>
        </div>
        <div class="stat-card">
            <h3>Average Order Value</h3>
            <div class="number">₹{{ number_format($average_order_value ?? 0, 2) }}</div>
        </div>
    </div>

    <!-- Customers Table -->
    <table class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Date</th>
                <th>Total Orders</th>
                <th>Total Spent</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone ?? 'N/A' }}</td>
                <td>{{ $customer->created_at->format('M d, Y') }}</td>
                <td>
                    <span style="
                        padding: 4px 8px;
                        border-radius: 4px;
                        font-size: 12px;
                        font-weight: bold;
                        background: 
                            @if($customer->orders_count > 5) #d4edda
                            @elseif($customer->orders_count > 0) #d1ecf1
                            @else #f8d7da
                            @endif;
                        color: 
                            @if($customer->orders_count > 5) #155724
                            @elseif($customer->orders_count > 0) #0c5460
                            @else #721c24
                            @endif;
                    ">
                        {{ $customer->orders_count }}
                    </span>
                </td>
                <td>₹{{ number_format($customer->orders_sum_total ?? 0, 2) }}</td>
                <td>
                    @if($customer->orders_count > 0)
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; background: #d4edda; color: #155724;">
                            Active
                        </span>
                    @else
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; background: #f8d7da; color: #721c24;">
                            Inactive
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="margin-top: 20px;">
        {{ $customers->links() }}
    </div>
</div>
@endsection
