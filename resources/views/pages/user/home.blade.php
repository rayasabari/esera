@extends('layouts.app')

@section('head', 'Home User - SRA')

@section('subheader', 'Dasboard')
@section('sub_subheader')
<span class="kt-subheader__breadcrumbs-separator"></span>
<a href="{{ url('/home') }}" class="kt-subheader__breadcrumbs-link">Home</a>
@endsection

@section('content')
    <div class="kt-portlet kt-portlet--height-fluid-">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                    <i class="flaticon-more-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                </div>
            </div>
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
                                {{ Auth::user()->name }}
                                <i class="flaticon2-correct kt-font-success"></i>
                            </a>
                            <span class="kt-widget__subtitle">
                                Head of Development
                            </span>
                        </div>
                        <div class="kt-widget__action">
                            <button type="button" class="btn btn-info btn-sm">chat</button>&nbsp;
                            <button type="button" class="btn btn-success btn-sm">follow</button>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Email:</span>
                            <a href="#" class="kt-widget__data">matt@fifestudios.com</a>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Phone:</span>
                            <a href="#" class="kt-widget__data">44(76)34254578</a>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Location:</span>
                            <span class="kt-widget__data">Melbourne</span>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Widget -->
        </div>
    </div>
@endsection
