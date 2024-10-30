@extends('auth.layouts')

@section('content')
<div class="container mt-5">
    <h1>Curriculum Vitae</h1>
    <div class="card">
        <div class="card-header">Personal Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $cv->name }}</p>
            <p><strong>Email:</strong> {{ $cv->email }}</p>
            <p><strong>Phone:</strong> {{ $cv->phone }}</p>
            <p><strong>Address:</strong> {{ $cv->address }}</p>
            <a href="{{ route('cv.edit') }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
    <!-- Tambahkan bagian pendidikan, pengalaman kerja, keterampilan, dan proyek sesuai kebutuhan -->
</div>
@endsection
