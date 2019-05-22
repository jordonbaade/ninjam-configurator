@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-1">
                <form method="POST" action="{{ route('ninjam') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="action" value="status">
                    <input class="mr-2 btn btn-light btn-sm" type="submit" value="Status"></input>
                </form>
                <form method="POST" action="{{ route('ninjam') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="action" value="start">
                    <input class="mr-2 btn btn-light btn-sm" type="submit" value="Start"></input>
                </form>
                <form method="POST" action="{{ route('ninjam') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="action" value="restart">
                    <input class="mr-2 btn btn-light btn-sm" type="submit" value="Restart"></input>
                </form>
                <form method="POST" action="{{ route('ninjam') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="action" value="stop">
                    <input class="btn btn-light btn-sm" type="submit" value="Stop"></input>
                </form>
            </div>
            <div class="card">
                <div class="card-header">Ninjam Configurator</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failed') }}
                        </div>
                    @endif
                    @if (session('ninjam_output'))
                        <div class="alert alert-info" role="alert">
                            <b>Command ouput:</b><br>
                            {{ session('ninjam_output') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('save') }}">
                    @csrf
                    <div class="form-group">
                        <label style="width: 100%;">
                            <textarea
                                name="config"
                                id=""
                                cols="30"
                                rows="10"
                                class="form-control"
                                style="width: 100%;"
                            >{{ old('config') ?? $config }}</textarea>
                        </label>
                    </div>
                    <button class="float-right btn btn-primary" type="submit">Save</button>
                    <a href="{{ route('backup') }}" class="float-right btn btn-secondary mr-2" role="button">Download Backup</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
