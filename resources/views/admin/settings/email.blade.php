<x-app-layout>

    @section('title', 'Email Configturion')
    @section('page-title', 'Email Configturion')
    @section('breadcrumb', Breadcrumbs::render('admin.dashboard'))

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.setting.email')}}" method="post">
                @method('put')
                @csrf
                <div class="row">

                    {{-- smtp host --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" name="smtp_host"
                            value="{{ old('smtp_host', $emailConfig->smtp_host) }}" placeholder="Enter SMTP host">
                        @error('smtp_host')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- smtp port --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Port</label>
                        <input type="number" class="form-control" name="smtp_port"
                            value="{{ old('smtp_port', $emailConfig->smtp_port) }}" placeholder="Enter SMTP port">
                        @error('smtp_port')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- smtp username --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Username</label>
                        <input type="text" class="form-control" name="smtp_username"
                            value="{{ old('smtp_username', $emailConfig->smtp_username) }}"
                            placeholder="Enter SMTP username">
                        @error('smtp_username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- smtp password --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Password</label>
                        <input type="password" class="form-control" name="smtp_password"
                            value="{{ old('smtp_password', $emailConfig->smtp_password) }}"
                            placeholder="Enter SMTP password">
                        @error('smtp_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- smtp encryption --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Encryption</label>
                        <select class="form-control" name="smtp_encryption">
                            <option value="" {{ old('smtp_encryption', $emailConfig->smtp_encryption) == '' ? 'selected' : '' }}>
                                None</option>
                            <option value="tls" {{ old('smtp_encryption', $emailConfig->smtp_encryption) == 'tls' ? 'selected' : '' }}>
                                TLS</option>
                            <option value="ssl" {{ old('smtp_encryption', $emailConfig->smtp_encryption) == 'ssl' ? 'selected' : '' }}>
                                SSL</option>
                        </select>
                        @error('smtp_encryption')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- from address --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">From Address</label>
                        <input type="email" class="form-control" name="from_address"
                            value="{{ old('from_address', $emailConfig->from_address) }}"
                            placeholder="Enter from address">
                        @error('from_address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- from name --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">From Name</label>
                        <input type="text" class="form-control" name="from_name"
                            value="{{ old('from_name', $emailConfig->from_name) }}" placeholder="Enter from name">
                        @error('from_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- reply to --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Reply-To Address</label>
                        <input type="email" class="form-control" name="reply_to_address"
                            value="{{ old('reply_to_address', $emailConfig->reply_to_address) }}"
                            placeholder="Enter reply-to address">
                        @error('reply_to_address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- reply name --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Reply-To Name</label>
                        <input type="text" class="form-control" name="reply_to_name"
                            value="{{ old('reply_to_name', $emailConfig->reply_to_name) }}"
                            placeholder="Enter reply-to name">
                        @error('reply_to_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- enable --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Enable Email</label>
                        <select class="form-control" name="enable">
                            <option value="1" {{ old('enable', $emailConfig->enable) == 1 ? 'selected' : '' }}>
                                Yes</option>
                            <option value="0" {{ old('enable', $emailConfig->enable) == 0 ? 'selected' : '' }}>
                                No</option>
                        </select>
                        @error('enable')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary px-3">Update</button>

            </form>
        </div>
    </div>
</x-app-layout>