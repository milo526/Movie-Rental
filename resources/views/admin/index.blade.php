@extends('layouts/admin_layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="col-md-6">
        <h1>Stats</h1>
        <h4>Rentals</h4>
        <ul>
            <li>With Invoice: {{DB::table('rentals')->whereNotNull('invoice_id')->count()}}</li>
            <li>Without Invoice: {{DB::table('rentals')->whereNull('invoice_id')->count()}}</li>
            <li>Total: {{DB::table('rentals')->count()}}</li>
        </ul>

        <h4>Invoices</h4>
        <ul>
            <li>Payed: {{$invoices->where('payed', 1)->count()}}</li>
            <li>Unpayed: {{$invoices->where('payed', 0)->count()}}</li>
            <li>Total: {{$invoices->count()}}</li>
        </ul>

        <h4>Users</h4>
        <ul>
            <li>Total: {{$users->count()}}</li>
        </ul>
    </div>
</div>
@endsection