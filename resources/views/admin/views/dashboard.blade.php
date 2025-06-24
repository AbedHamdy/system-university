@extends('admin.layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="profile-wrapper" style="background: #fff; min-height: calc(100vh - 100px); padding: 30px 20px; display: flex; justify-content: center; align-items: center;">
        <div class="admin-card">
            {{-- صورة الأدمن --}}
            <img src="{{ asset('images/admins/' . $admin->image) }}" alt="Admin Image">

            {{-- معلومات الأدمن --}}
            <p><span class="info-label">Name:</span> {{ $admin->name }}</p>
            <p><span class="info-label">Email:</span> {{ $admin->email }}</p>
            <p><span class="info-label">Specialization:</span> {{ $admin->category->name ?? 'N/A' }}</p>
            <p><span class="info-label">Joined At:</span> {{ $admin->created_at->format('Y-m-d H:i') }}</p>

            {{-- زر تعديل البيانات --}}
            <a href="" class="edit-btn">Edit Profile</a>
        </div>
    </div>
@endsection
