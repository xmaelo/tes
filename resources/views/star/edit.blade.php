@extends('base')

@section('title', 'Ajout')


@section('content')
<div class="rt-container">
    
    <div class="col-rt-12">
        <img src="{{url('storage/'.$star->image)}}" alt="" width="300" height="300">
        <div class="Scriptcontent">
            <form method="POST" action="{{ url('star/'. $star->id.'/edit') }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <input type="text" required name="nom"  value="{{$star->nom}}" placeholder="nom" id="nom">
                <br>
                <input type="text" required name="prenom" value="{{$star->prenom}}" placeholder="prenom" id="prenom">
                <br>
                <textarea type="text" required name="description"  placeholder="description" id="description"> {{$star->description}} </textarea>
                <input type="file" name="image" id="image" >

                <input type="submit" value="mettre a jour">
            </form>
        </div>
    </div>

</div>
@endsection
@section('javascript')
    <script>
        $("form").submit(function(event){
            try{
                console.log("Submitting form start here", "{{ csrf_token() }}");
                event.preventDefault();
                console.log('1')
                const nom = $('#nom').val()
                const description = $('#description').val()
                const prenom = $('#prenom').val()
                let image;
                const formData = new FormData();

                if($("#image") && $("#image")[0]) {
                    image = $("#image")[0]?.files[0]
                    try{
                        formData.append("image", image, image.name);
                    }catch(e){
                        console.log('error form data append', e)
                        formData.append("image", null);
                    }
                }
                console.log('1')

                
                formData.append("nom", nom)
                formData.append("description", description)
                formData.append("prenom", prenom)
                formData.append("_token", "{{ csrf_token() }}")

                console.log(formData)
                
                $.ajax({
                    url: '/star/{{$star->id}}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){
                        console.log('status', data)
                        if(!data.error){
                            window.location.href = "/star"
                        }
                    }
                });
            }catch(e){
                console.log('errrr', e)
            }

            
        });
    </script>
@endsection