@extends('base')

@section('title', 'Tous')



@section('content')
    <div>
        
        <section>
            <div class="rt-container">
                <br>
                <a href="{{ url('star/create') }}">Ajouter</a>
                <br>
                <div>
                    <div class="col-rt-12 card" >
                        <div class="Scriptcontent">
                            <div id="parentVerticalTab">
                                <ul class="resp-tabs-list hor_1 ul1" >
                                    @foreach($stars as $star)
                                        <li style="background-color: #D5D5D5;">{{$star->prenom}} {{$star->nom}}</li>
                                    @endforeach
                                </ul>
                                <div class="resp-tabs-container hor_1">
                                    @foreach($stars as $star)
                                        <div>
                                            <div>
                                                <h2 style="margin-left: 15px; margin-top: -15px;">Profile browser</h2>
                                                <br>
                                                <br>
                                                <div>
                                                    <div class="card2">
                                                        <img src="{{url('storage/'.$star->image)}}" alt="" style="width: 100%;">
                                                    </div>

                                                    <p style="padding-left: 10px;">
                                                        {{$star->description}}
                                                    </p>
                                                </div>


                                            </div>
                                            <div style="display: flex; margin-top: 20px;">
                                                <form method="POST" action="{{ url('/star' . '/' .$star->id) }}">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" title="">Effacer</button>
                                                </form>

                                                <a href="{{ url('star/'.$star->id.'/edit') }}" style="margin-left: 20px;"> Modifier</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $('#parentVerticalTab').easyResponsiveTabs({
                type: 'vertical', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo2');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
        });
        $(function () {
            console.log('doc doc mount')
        });
    </script>
@endsection


