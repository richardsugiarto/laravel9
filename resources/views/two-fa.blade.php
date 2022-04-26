@extends('layouts.app')
@section ('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-header">{{__('Two Factor Authentication')}} : </div>

      <div class="card-body">
        @if(session('status')=="two-factor-authentication-enabled")
          <div class="alert alert-success" role="alert">
            Two Factor Authentication has been enabled
          </div>
        @endif
        @if(session('status')=="two-factor-authentication-disabled")
          <div class="alert alert-success" role="alert">
            Two Factor Authentication has been disabled
          </div>
        @endif
      <form method="POST" action="/user/two-factor-authentication">
        @csrf
        @if(Auth::user()->two_factor_secret)
        Please scan the QR Code
        @method('DELETE')
        <div class="pb-5">
          {!! Auth::user()->twoFactorQrCodeSvg() !!}
        </div>
        
        <div class="pb-5">
          <h3>Recovery Codes</h3>
          @foreach (json_decode(decrypt(Auth::user()->two_factor_recovery_codes)) as $code)
            <li>{{$code}}</li>
          @endforeach
        </div>
         <button class="btn btn-dark">{{__('Disable')}}</button>
        @else
        {{__('Not Enabled')}}
        <br><button class="btn btn-dark">{{__('Enable')}}</button>
        @endif
      </form>
      </div>
    </div>
  </div>
</div>
@endsection