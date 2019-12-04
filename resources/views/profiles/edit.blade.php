@extends('layouts.app-user')


@section('head')
    <title>Profile - </title>
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/profile/') }}" class="kt-subheader__breadcrumbs-link">Profile</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    @if(Request::segment(4) == 'biodata')
        <a href="{{ url('/profile/'.$user->name.'/biodata') }}" class="kt-subheader__breadcrumbs-link">Biodata</a>
    @elseif(Request::segment(4) == 'akuninfo')
        <a href="{{ url('/profile/'.$user->name.'/akuninfo') }}" class="kt-subheader__breadcrumbs-link">Informasi Akun</a>
    @elseif(Request::segment(4) == 'gantipassword')
        <a href="{{ url('/profile/'.$user->name.'/gantipassword') }}" class="kt-subheader__breadcrumbs-link">Ganti Password</a>
    @endif
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
    @endif

    {{-- @if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error )
            • {{ $error }}<br>
        @endforeach
    </div>
    @endif --}}

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
        <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

            <!--begin:: Widgets/Applications/User/Profile1-->
            <div class="kt-portlet">
                <div class="kt-portlet__head  kt-portlet__head--noborder mt-n4">
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit-y">

                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-1">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                <img src="assets/media/users/100_13.jpg" alt="image">
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                                    <a href="#" class="kt-widget__username">
                                        {{ $user->first_name .' '. $user->last_name }}
                                        @if(isset($nipl))
                                            <i class="flaticon2-correct text-success"  data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Verified Bidder" ></i>
                                        @endif
                                    </a>
                                    <span class="kt-widget__subtitle">
                                        Saldo <b>Rp {{ number_format($nipl->deposite,0,',','.') }}</b>
                                    </span>
                                </div>
                                <div class="kt-widget__action">
                                    <button type="button" class="btn btn-info btn-sm">Setor</button>&nbsp;
                                    <button type="button" class="btn btn-success btn-sm">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <div class="kt-widget__content">
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">NIPL:</span>
                                <a href="#" class="kt-widget__data"></a>{{$nipl->nipl}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Email:</span>
                                <a href="#" class="kt-widget__data"></a>{{$user->email}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Telepon:</span>
                                    <a href="#" class="kt-widget__data">-</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Lokasi:</span>
                                    <span class="kt-widget__data">-</span>
                                </div>
                            </div>
                            <div class="kt-widget__items">
                            <a href="/profile/{{$user->name}}/edit/biodata" class="kt-widget__item {{ Request::segment(4) == 'biodata' ? 'kt-widget__item--active' : '' }}">
                                    <span class="kt-widget__section">
                                        <span class="kt-widget__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="kt-widget__desc">
                                            Biodata Diri
                                        </span>
                                    </span>
                                </a>
                                <a href="/profile/{{$user->name}}/edit/akuninfo" class="kt-widget__item {{ Request::segment(4) == 'akuninfo' ? 'kt-widget__item--active' : '' }}">
                                    <span class="kt-widget__section">
                                        <span class="kt-widget__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="kt-widget__desc">
                                            Informasi Akun
                                        </span>
                                    </span>
                                </a>
                                <a href="/profile/{{$user->name}}/edit/gantipassword" class="kt-widget__item {{ Request::segment(4) == 'gantipassword' ? 'kt-widget__item--active' : '' }}">
                                    <span class="kt-widget__section">
                                        <span class="kt-widget__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="kt-widget__desc">
                                            Ganti Password
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end::Widget -->
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile1-->
        </div>
        <!--End:: App Aside-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @if(Request::segment(4) == 'biodata')
                        @include('profiles.form-biodata')
                    @elseif(Request::segment(4) == 'akuninfo')
                        @include('profiles.form-akuninfo')
                    @elseif(Request::segment(4) == 'gantipassword')
                        @include('profiles.form-gantipassword')
                    @endif
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->

    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body p-0">
                        @if ($user->profile)
                            @if (Auth::user()->id == $user->id)
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-3 profile-sidebar text-white rounded-left-sm-up">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" data-toggle="pill" href=".edit-profile-tab" role="tab" aria-controls="edit-profile-tab" aria-selected="true">
                                                {{ trans('profile.editProfileTitle') }}
                                            </a>
                                            <a class="nav-link" data-toggle="pill" href=".edit-settings-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                                                {{ trans('profile.editAccountTitle') }}
                                            </a>
                                            <a class="nav-link" data-toggle="pill" href=".edit-account-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                                                {{ trans('profile.editAccountAdminTitle') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
                                                <div class="row mb-1">
                                                    <div class="col-sm-12">
                                                        <div id="avatar_container">
                                                            <div class="collapseOne card-collapse collapse @if($user->profile->avatar_status == 0) show @endif">
                                                                <div class="card-body">
                                                                    <img src="{{  Gravatar::get($user->email) }}" alt="{{ $user->name }}" class="user-avatar">
                                                                </div>
                                                            </div>
                                                            <div class="collapseTwo card-collapse collapse @if($user->profile->avatar_status == 1) show @endif">
                                                                <div class="card-body">
                                                                    <div class="dz-preview"></div>
                                                                    {!! Form::open(array('route' => 'avatar.upload', 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true)) !!}
                                                                        <img id="user_selected_avatar" class="user-avatar" src="@if ($user->profile->avatar != NULL) {{ $user->profile->avatar }} @endif" alt="{{ $user->name }}">
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name], 'id' => 'user_profile_form', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-10 offset-1 col-sm-10 offset-sm-1 mb-1">
                                                            <div class="row" data-toggle="buttons">
                                                                <div class="col-6 col-xs-6 right-btn-container">
                                                                    <label class="btn btn-primary @if($user->profile->avatar_status == 0) active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne:not(.show), .collapseTwo.show">
                                                                        <input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" @if($user->profile->avatar_status == 0) checked @endif> Use Gravatar
                                                                    </label>
                                                                </div>
                                                                <div class="col-6 col-xs-6 left-btn-container">
                                                                    <label class="btn btn-primary @if($user->profile->avatar_status == 1) active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne.show, .collapseTwo:not(.show)">
                                                                        <input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" @if($user->profile->avatar_status == 1) checked @endif> Use My Image
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('theme') ? ' has-error ' : '' }}">
                                                        {!! Form::label('theme_id', trans('profile.label-theme') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            <select class="form-control" name="theme_id" id="theme_id">
                                                                @if ($themes->count())
                                                                    @foreach($themes as $theme)
                                                                      <option value="{{ $theme->id }}"{{ $currentTheme->id == $theme->id ? 'selected="selected"' : '' }}>{{ $theme->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="glyphicon {{ $errors->has('theme') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('theme'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('theme') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error ' : '' }}">
                                                        {!! Form::label('location', trans('profile.label-location') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => trans('profile.ph-location'))) !!}
                                                            <span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('location'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('location') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('bio') ? ' has-error ' : '' }}">
                                                        {!! Form::label('bio', trans('profile.label-bio') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control', 'placeholder' => trans('profile.ph-bio'))) !!}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('bio'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('bio') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('twitter_username') ? ' has-error ' : '' }}">
                                                        {!! Form::label('twitter_username', trans('profile.label-twitter_username') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-twitter_username'))) !!}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('twitter_username'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('twitter_username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="margin-bottom-2 form-group has-feedback {{ $errors->has('github_username') ? ' has-error ' : '' }}">
                                                        {!! Form::label('github_username', trans('profile.label-github_username') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-github_username'))) !!}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('github_username'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('github_username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group margin-bottom-2">
                                                        <div class="col-12">
                                                            {!! Form::button(
                                                                '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitButton'),
                                                                 array(
                                                                    'id'                => 'confirmFormSave',
                                                                    'class'             => 'btn btn-success disabled',
                                                                    'type'              => 'button',
                                                                    'data-target'       => '#confirmForm',
                                                                    'data-modalClass'   => 'modal-success',
                                                                    'data-toggle'       => 'modal',
                                                                    'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                                                    'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                                            )) !!}

                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>

                                            <div class="tab-pane fade edit-settings-tab" role="tabpanel" aria-labelledby="edit-settings-tab">
                                                {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form')) !!}

                                                    {!! csrf_field() !!}

                                                    <div class="pt-4 pr-3 pl-2 form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                                        {!! Form::label('name', trans('forms.create_user_label_username'), array('class' => 'col-md-3 control-label')); !!}
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                                                                <div class="input-group-append">
                                                                    <label class="input-group-text" for="name">
                                                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                                        {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                                                                <div class="input-group-append">
                                                                    <label for="email" class="input-group-text">
                                                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                                                        {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                                                                <div class="input-group-append">
                                                                    <label class="input-group-text" for="first_name">
                                                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                                                        {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                                                                <div class="input-group-append">
                                                                    <label class="input-group-text" for="last_name">
                                                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-9 offset-md-3">
                                                            {!! Form::button(
                                                                '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitProfileButton'),
                                                                 array(
                                                                    'class'             => 'btn btn-success disabled',
                                                                    'id'                => 'account_save_trigger',
                                                                    'disabled'          => true,
                                                                    'type'              => 'button',
                                                                    'data-submit'       => trans('profile.submitProfileButton'),
                                                                    'data-target'       => '#confirmForm',
                                                                    'data-modalClass'   => 'modal-success',
                                                                    'data-toggle'       => 'modal',
                                                                    'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                                                    'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                                            )) !!}
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>

                                            <div class="tab-pane fade edit-account-tab" role="tabpanel" aria-labelledby="edit-account-tab">
                                                <ul class="account-admin-subnav nav nav-pills nav-justified margin-bottom-3 margin-top-1">
                                                    <li class="nav-item bg-info">
                                                        <a data-toggle="pill" href="#changepw" class="nav-link warning-pill-trigger text-white active" aria-selected="true">
                                                            {{ trans('profile.changePwPill') }}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item bg-info">
                                                        <a data-toggle="pill" href="#deleteAccount" class="nav-link danger-pill-trigger text-white">
                                                            {{ trans('profile.deleteAccountPill') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">

                                                    <div id="changepw" class="tab-pane fade show active">

                                                        <h3 class="margin-bottom-1 text-center text-warning">
                                                            {{ trans('profile.changePwTitle') }}
                                                        </h3>

                                                        {!! Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')) !!}

                                                            <div class="pw-change-container margin-bottom-2">

                                                                <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                                                    {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
                                                                    <div class="col-md-9">
                                                                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'), 'autocomplete' => 'new-password')) !!}
                                                                        @if ($errors->has('password'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                                                    {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                                                                    <div class="col-md-9">
                                                                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                                                                        <span id="pw_status"></span>
                                                                        @if ($errors->has('password_confirmation'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-9 offset-md-3">
                                                                    {!! Form::button(
                                                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitPWButton'),
                                                                         array(
                                                                            'class'             => 'btn btn-warning',
                                                                            'id'                => 'pw_save_trigger',
                                                                            'disabled'          => true,
                                                                            'type'              => 'button',
                                                                            'data-submit'       => trans('profile.submitButton'),
                                                                            'data-target'       => '#confirmForm',
                                                                            'data-modalClass'   => 'modal-warning',
                                                                            'data-toggle'       => 'modal',
                                                                            'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                                                            'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                                                    )) !!}
                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}

                                                    </div>

                                                    <div id="deleteAccount" class="tab-pane fade">
                                                        <h3 class="margin-bottom-1 text-center text-danger">
                                                            {{ trans('profile.deleteAccountTitle') }}
                                                        </h3>
                                                        <p class="margin-bottom-2 text-center">
                                                            <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                                                <strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
                                                            <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                                        </p>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6 offset-sm-3 margin-bottom-3 text-center">

                                                                {!! Form::model($user, array('action' => array('ProfilesController@deleteUserAccount', $user->id), 'method' => 'DELETE')) !!}

                                                                    <div class="btn-group btn-group-vertical margin-bottom-2 custom-checkbox-fa" data-toggle="buttons">
                                                                        <label class="btn no-shadow" for="checkConfirmDelete" >
                                                                            <input type="checkbox" name='checkConfirmDelete' id="checkConfirmDelete">
                                                                            <i class="fa fa-square-o fa-fw fa-2x"></i>
                                                                            <i class="fa fa-check-square-o fa-fw fa-2x"></i>
                                                                            <span class="margin-left-2"> Confirm Account Deletion</span>
                                                                        </label>
                                                                    </div>

                                                                    {!! Form::button(
                                                                        '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> ' . trans('profile.deleteAccountBtn'),
                                                                        array(
                                                                            'class'             => 'btn btn-block btn-danger',
                                                                            'id'                => 'delete_account_trigger',
                                                                            'disabled'          => true,
                                                                            'type'              => 'button',
                                                                            'data-toggle'       => 'modal',
                                                                            'data-submit'       => trans('profile.deleteAccountBtnConfirm'),
                                                                            'data-target'       => '#confirmForm',
                                                                            'data-modalClass'   => 'modal-danger',
                                                                            'data-title'        => trans('profile.deleteAccountConfirmTitle'),
                                                                            'data-message'      => trans('profile.deleteAccountConfirmMsg')
                                                                        )
                                                                    ) !!}

                                                                {!! Form::close() !!}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <p>{{ trans('profile.notYourProfile') }}</p>
                            @endif
                        @else
                            <p>{{ trans('profile.noProfileYet') }}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @include('modals.modal-form')

@endsection

@section('footer_scripts')

    @include('scripts.form-modal-script')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.gmaps-address-lookup-api3')
    @endif

    @include('scripts.user-avatar-dz')

    <script type="text/javascript">

        $('.dropdown-menu li a').click(function() {
            $('.dropdown-menu li').removeClass('active');
        });

        $('.profile-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-default');
        });

        $('.settings-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-info');
        });

        $('.admin-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });

        $('.warning-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
        });

        $('.danger-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-danger');
        });

        $('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });

        $('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });

        $('#checkConfirmDelete').change(function() {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);

            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            }
            else {
                submitDelete.attr('disabled', true);
            }
        });

        $("#password_confirmation").keyup(function() {
            checkPasswordMatch();
        });

        $("#password, #password_confirmation").keyup(function() {
            enableSubmitPWCheck();
        });

        $('#password, #password_confirmation').hidePassword(true);

        $('#password').password({
            shortPass: 'The password is too short',
            badPass: 'Weak - Try combining letters & numbers',
            goodPass: 'Medium - Try using special charecters',
            strongPass: 'Strong password',
            containsUsername: 'The password contains the username',
            enterPass: false,
            showPercent: false,
            showText: true,
            animate: true,
            animateSpeed: 50,
            username: false, // select the username field (selector or jQuery instance) for better password checks
            usernamePartialMatch: true,
            minimumLength: 6
        });

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if (password != confirmPassword) {
                $("#pw_status").html("Passwords do not match!");
            }
            else {
                $("#pw_status").html("Passwords match.");
            }
        }

        function enableSubmitPWCheck() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            var submitChange = $('#pw_save_trigger');
            if (password != confirmPassword) {
                submitChange.attr('disabled', true);
            }
            else {
                submitChange.attr('disabled', false);
            }
        }

    </script>

@endsection
