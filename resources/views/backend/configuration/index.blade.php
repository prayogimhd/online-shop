@extends('layouts.backend.app')
@section('content')
    <div class="main-content" style="min-height: 834px;">
        <section class="section">
            <div class="section-header">
                <h1>Configuration</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Configuration</div>
                </div>
            </div>

            <div class="section-body">
                <div class="viewmodal"></div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-circle-edit-outline"></i> Configuration Website
                                <hr>
                                <form id="formStore">
                                    <input type="hidden" class="form-control" id="configuration_id"
                                        value="{{ $configuration->id }}" name="configuration_id" readonly>
                                    <div class="form-group">
                                        <label>
                                            Name
                                        </label>
                                        <input type="text" id="name" value="{{ $configuration->name }}"
                                            name="name" class="form-control">
                                        <div class="invalid-feedback errorname">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Description
                                        </label>
                                        <textarea type="text" id="description" name="description" class="form-control">{{ $configuration->description }}</textarea>
                                        <div class="invalid-feedback errordescription">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Address
                                        </label>
                                        <textarea type="text" id="address" name="address" class="form-control">{{ $configuration->address }}</textarea>
                                        <div class="invalid-feedback erroraddress">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>
                                                Email
                                            </label>
                                            <input type="text" id="email" name="email"
                                                value="{{ $configuration->email }}" class="form-control">
                                            <div class="invalid-feedback erroremail">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>
                                                Phone
                                            </label>
                                            <input type="text" id="phone" name="phone"
                                                value="{{ $configuration->phone }}" class="form-control">
                                            <div class="invalid-feedback errorphone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>
                                                Facebook
                                            </label>
                                            <input type="text" id="facebook" name="facebook"
                                                value="{{ $configuration->facebook }}" class="form-control">
                                            <div class="invalid-feedback errorfacebook">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>
                                                Instagram
                                            </label>
                                            <input type="text" id="instagram" name="instagram"
                                                value="{{ $configuration->instagram }}" class="form-control">
                                            <div class="invalid-feedback errorinstagram">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btnsimpan"><i class="fa fa-paper-plane"></i>
                                        Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-image-filter-vintage"></i> Icon Website <br>
                                <small class="text-danger">*click the icon to change it</small>
                                <hr>
                                <div class="form-group text-center">
                                    <img class="img-thumbnail" onclick="icon({{ $configuration->id }})"
                                        src="{{ asset('backend/configuration/' . $configuration->icon) }}" width="60%"
                                        alt="Foto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('js')
        <script src="{{ asset('backend/script/configuration.js') }}"></script>
    @endpush
@endsection
