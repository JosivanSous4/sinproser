<div class="col-md-6 col-lg-4">
    <div class="pl-20 pl-md-0">
        
        <div class="mtb-50 mb-md-0">
            @include('site.partials.informacoes')
        </div>

        <div class="mb-md-0">
            <h4 class="p-title"><b>PARCEIROS</b></h4>
            @if(isset($parceiros) && !emppty($parceiros))
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach(\App\Models\Site\Parceiro::get() as $index => $parceiro)
                            <li data-target="#carousel" data-slide-to="{{$index}}" class="@if($index == 0) active @endif"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach(\App\Models\Site\Parceiro::get() as $index => $parceiro)
                            <div class="carousel-item @if($index == 0) active @endif" style="height: 247px;">
                                <img class="d-block w-100" src="storage/uploads/{{$parceiro->foto}}" alt="First slide">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            @else
            <ul class="font-11 list-relative list-li-pl-30 list-block list-li-mb-15">
                <li>
                    <i class="abs-tl ion-thumbsdown"></i> Nenhum parceiro cadastrado.
                </li>
            </ul>
            @endif
    </div>
</div>