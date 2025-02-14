<x-app-layout>

    @section('title', 'General Setting')
    @section('page-title', 'General Setting')
    @section('breadcrumb', Breadcrumbs::render('admin.dashboard'))

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.setting.general')}}" method="post">
                @method('put')
                @csrf
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date Format</label>
                        <select class="form-control" name="date_format">
                            <option value="">Select Date Format</option>
                            <option value="Y-m-d"
                                {{ old('date_format', $generalSetting->date_format) === 'Y-m-d' ? 'selected' : '' }}>
                                YYYY-MM-DD
                            </option>
                            <option value="m/d/Y"
                                {{ old('date_format', $generalSetting->date_format) === 'm/d/Y' ? 'selected' : '' }}>
                                MM/DD/YYYY
                            </option>
                            <option value="d-m-Y"
                                {{ old('date_format', $generalSetting->date_format) === 'd-m-Y' ? 'selected' : '' }}>
                                DD-MM-YYYY
                            </option>
                        </select>
                        @error('date_format')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Default Currency</label>
                        <select class="form-control" name="default_currency">
                            <option value="">Select Currency</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}"
                                    {{ old('default_currency', $generalSetting->default_currency) == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->name }} ({{ $currency->symbol }})
                                </option>
                            @endforeach
                        </select>
                        @error('default_currency')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Timezone</label>
                        <select class="form-control" name="timezone">
                            <option value="">Select Timezone</option>
                            @foreach (timezone_identifiers_list() as $timezone)
                                <option value="{{ $timezone }}"
                                    {{ old('timezone', $generalSetting->timezone) == $timezone ? 'selected' : '' }}>
                                    {{ $timezone }}</option>
                            @endforeach
                        </select>
                        @error('timezone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Language</label>
                        <select class="form-control" name="language">
                            <option value="">Select Language</option>
                            <option value="en"
                                {{ old('language', $generalSetting->language) == 'en' ? 'selected' : '' }}>English
                            </option>
                            <option value="hi"
                                {{ old('language', $generalSetting->language) == 'hi' ? 'selected' : '' }}>Hindi
                            </option>
                            <!-- Add more languages as needed -->
                        </select>
                        @error('language')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Session Timeout (in minutes)</label>
                        <input type="number" class="form-control" placeholder="Enter session timeout"
                            value="{{ old('session_timeout', $generalSetting->session_timeout) }}"
                            name="session_timeout">
                        @error('session_timeout')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Copyright</label>
                        <input type="text" class="form-control" placeholder="Enter copyright text"
                            value="{{ old('copyright', $generalSetting->copyright) }}" name="copyright">
                        @error('copyright')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Developed By</label>
                        <input type="text" class="form-control" placeholder="Enter developer name"
                            value="{{ old('developed_by', $generalSetting->developed_by) }}" name="developed_by">
                        @error('developed_by')
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