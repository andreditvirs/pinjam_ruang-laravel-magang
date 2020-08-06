<html>
    <head></head>
<body>
    <form method="POST" action="http://127.0.0.1/pinjam_ruang_user/pinjam_ruang_user/public/bookings">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="r_id" type="text" class="form-control @error('name') is-invalid @enderror" name="r_id" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="u_id" type="text" class="form-control @error('email') is-invalid @enderror" name="u_id" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <input id="keperluan" type="text" class="form-control @error('email') is-invalid @enderror" name="keperluan" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <input id="tanggal_mulai" type="text" class="form-control @error('email') is-invalid @enderror" name="tanggal_mulai" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <input id="tanggal_selesai" type="text" class="form-control @error('email') is-invalid @enderror" name="tanggal_selesai" value="{{ old('email') }}" required autocomplete="email">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
</div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>
{{-- {{ $json["success"]["token"] }} --}}
</body>
    </html>