@extends('layouts.app')

@section('head')
    <title>List Objek Lelang - SRA</title>
@endsection

@section('content')
    <div class="kt-container">
        @foreach($objek as $obj)
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media kt-hidden-">
                                <img src="https://1.bp.blogspot.com/-uJMphbPemCU/VuZNtOFkIZI/AAAAAAAATGE/jCeiX29Ae28cGIt0ElK3eMQbg7TFSop-g/s1600/PENJELASAN%2BTIPE%2BRUMAH%2B21%2Bdenah1.jpg" alt="image">
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="#" class="kt-widget__username">
                                        {{ $obj->objek_properti->nama }}    
                                        <i class="flaticon2-correct kt-font-success"></i>                       
                                    </a>

                                    <div class="kt-widget__action">
                                        <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                        <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                    </div>
                                </div>

                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-new-email"></i>jason@siastudio.com</a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>
                                    <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>
                                </div>

                                <div class="kt-widget__info">
                                    <div class="kt-widget__desc">
                                        I distinguish three main text objektive could be merely to inform people.
                                        <br> A second could be persuade people.You want people to bay objective
                                    </div>
                                    <div class="kt-widget__progress">
                                        <div class="kt-widget__text">
                                            Progress
                                        </div>
                                        <div class="progress" style="height: 5px;width: 100%;">
                                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="kt-widget__stats">
                                            78%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__bottom">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-price-tag text-black-50"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Harga Limit</span>
                                    <span class="kt-widget__value text-success">Rp {{ number_format($obj->objek_properti->harga_limit,0,',','.') }}</span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-safe-shield-protection text-black-50"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Jaminan</span>
                                    <span class="kt-widget__value text-primary">Rp {{ number_format($obj->objek_properti->jaminan,0,',','.') }}</span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-pie-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">On going Bid</span>
                                    <span class="kt-widget__value"><span>$</span>782,300</span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-file-2"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">73 Tasks</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-chat-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">648 Comments</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-network"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <div class="kt-section__content kt-section__content--solid">
                                        <div class="kt-media-group">
                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                                <img src="/metronic/themes/metronic/theme/default/demo1/dist/assets/media/users/100_1.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                                <img src="/metronic/themes/metronic/theme/default/demo1/dist/assets/media/users/100_10.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                                <img src="/metronic/themes/metronic/theme/default/demo1/dist/assets/media/users/100_11.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                <img src="/metronic/themes/metronic/theme/default/demo1/dist/assets/media/users/100_3.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                <span>+5</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection