@extends('layouts.app-template')

@section('title')
    Tutoriais
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Inicio',
	            'link' : '/bens',
	        },
	        {
	            'nome' : 'Tutoriais',
	            'link' : '/tutoriais/',
	        }
	    ]">
    </sub-cabecalho>

    <div class="m-content">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Tutoriais
                        </h3>
                    </div>
                </div>
                <!-- <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
                                Today
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content1" role="tab">
                                Week
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab3_content1" role="tab">
                                Month
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-5" style="border-right: 1px solid #cacaca;">
                            <div class="m-widget2">
                                <div class="m-widget2__item m-widget2__item--primary">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__text">
                                            Cadastro de associado
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget2__item m-widget2__item--warning">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__user-name">
                                            <span class="m-widget2__text">
                                                Make Metronic Great  Again.Lorem Ipsum Amet
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget2__item m-widget2__item--brand">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__text">
                                            Make Widgets Great Again.Estudiat Communy Elit
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget2__item m-widget2__item--success">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__text">
                                            Make Metronic Great Again.Lorem Ipsum
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget2__item m-widget2__item--danger">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__text">
                                            Completa Financial Report For Emirates Airlines
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget2__item m-widget2__item--info">
                                    <div class="m-widget2__checkbox">
                                    </div>
                                    <div class="m-widget2__desc">
                                        <span class="m-widget2__text">
                                            Completa Financial Report For Emirates Airlines
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <!-- <video width="600" controls="controls">
                                <source src="{{asset('/storage/videos/video.m4v')}}" type="video/m4v">
                              Seu navegador não suporta o elemento <code>video</code>.
                            </video> -->

                            <video width="600" controls>
                                <source src="{{asset('/storage/videos/baixa_entrada_individual_e_coletivo.webm')}}" type="video/webm">
                            </video>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
