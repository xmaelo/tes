@extends('base')

@section('title', 'Tous')



@section('content')
    <div>
        
        <section>
            <div class="rt-container">
                <br>
                <a href="{{ url('star/create') }}">AJouter</a>
                <br>
                <div class="col-rt-12">
                    <div class="Scriptcontent">
                        <div id="parentVerticalTab">
                            <ul class="resp-tabs-list hor_1">
                                @foreach($stars as $star)
                                    <li>{{$star->prenom}} {{$star->nom}}</li>
                                @endforeach
                            </ul>
                            <div class="resp-tabs-container hor_1">
                                @foreach($stars as $star)
                                    <div style="text-align: center;">
                                        <img src="{{url('storage/'.$star->image)}}" alt="" width="300" height="300">
                                        <br>
                                     
                                        {{$star->description}}


                                        <form method="POST" action="{{ url('/star' . '/' .$star->id) }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" title="">Effacer</button>
                                          </form>

                                          <a href="{{ url('star/'.$star->id.'/edit') }}">Modifier</a>
                                    </div>
                                @endforeach
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
            //Horizontal Tab
            $('#parentHorizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
    
            // Child Tab
            $('#ChildVerticalTab_1').easyResponsiveTabs({
                type: 'vertical',
                width: 'auto',
                fit: true,
                tabidentify: 'ver_1', // The tab groups identifier
                activetab_bg: '#fff', // background color for active tabs in this group
                inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
                active_border_color: '#c1c1c1', // border color for active tabs heads in this group
                active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
            });
    
            //Vertical Tab
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