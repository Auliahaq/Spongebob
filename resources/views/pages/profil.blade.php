@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">
  <h2 class="profile-title">Pengaturan Profil</h2>

  <div class="profile-card">
    {{-- Form gabungan avatar + nama --}}
    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
      @csrf

      {{-- Kolom Kiri: Avatar --}}
      <div class="profile-avatar-section">
        <img src="{{ asset('storage/' . ($user->avatar ?? 'avatars/default.png')) }}" alt="Avatar" class="avatar-preview">
        <input type="file" name="avatar" accept="image/*" class="file-input">
      </div>

      {{-- Kolom Kanan: Informasi Editable --}}
      <div class="profile-info-section">
        <div class="info-row">
          <label class="info-label" for="name">Nama:</label>
          <div class="info-editable">
            <input type="text" name="name" id="nameInput" value="{{ $user->name }}" class="input-field" readonly>
            <button type="button" id="editBtn" class="edit-btn">Ubah</button>
            <button type="submit" id="saveBtn" class="save-btn" style="display: none;">Simpan</button>
          </div>
        </div>

        <div class="info-row">
          <label class="info-label">Email:</label>
          <span class="info-value">{{ $user->email }}</span>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const nameInput = document.getElementById('nameInput');

    editBtn.addEventListener('click', () => {
      nameInput.removeAttribute('readonly');
      nameInput.focus();
      editBtn.style.display = 'none';
      saveBtn.style.display = 'inline-block';
    });
  });
</script>
@endsection
