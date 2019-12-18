@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! 

                    <span>
                        
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form-admin').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
