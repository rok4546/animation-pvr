@extends('admin.layouts.base')

@section('title', 'General Settings')

@section('content')
<div class="card">
    <h2 style="margin: 0 0 20px 0;">🔧 General Settings</h2>

    <form method="POST" action="{{ route('admin.settings.general.update') }}">
        @csrf

        <div class="form-group">
            <label for="site_name">Site Name *</label>
            <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="site_email">Site Email *</label>
            <input type="email" id="site_email" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="site_phone">Site Phone</label>
            <input type="text" id="site_phone" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}">
        </div>

        <div class="form-group">
            <label for="site_address">Site Address</label>
            <textarea id="site_address" name="site_address" rows="3">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="site_description">Site Description</label>
            <textarea id="site_description" name="site_description" rows="4">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="currency">Currency *</label>
            <select id="currency" name="currency" required>
                <option value="INR" {{ ($settings['currency'] ?? 'INR') === 'INR' ? 'selected' : '' }}>INR (₹)</option>
                <option value="USD" {{ ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                <option value="EUR" {{ ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                <option value="GBP" {{ ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="timezone">Timezone *</label>
            <select id="timezone" name="timezone" required>
                <option value="Asia/Kolkata" {{ ($settings['timezone'] ?? 'Asia/Kolkata') === 'Asia/Kolkata' ? 'selected' : '' }}>Asia/Kolkata (IST)</option>
                <option value="America/New_York" {{ ($settings['timezone'] ?? '') === 'America/New_York' ? 'selected' : '' }}>America/New_York (EST)</option>
                <option value="Europe/London" {{ ($settings['timezone'] ?? '') === 'Europe/London' ? 'selected' : '' }}>Europe/London (GMT)</option>
                <option value="Asia/Tokyo" {{ ($settings['timezone'] ?? '') === 'Asia/Tokyo' ? 'selected' : '' }}>Asia/Tokyo (JST)</option>
                <option value="Australia/Sydney" {{ ($settings['timezone'] ?? '') === 'Australia/Sydney' ? 'selected' : '' }}>Australia/Sydney (AEST)</option>
            </select>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
