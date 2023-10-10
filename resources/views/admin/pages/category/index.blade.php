@extends('layouts.admin.app')

@section('title','Category Destination')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <livewire:admin.pages.category.index>
</div>

@push('modals-section')
<x-admin.basic-modal />
@endpush
@endsection