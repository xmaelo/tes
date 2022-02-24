@extends('base')

@section('title', 'Ajout')


@section('content')
<div>
    <br>
    <br>
    <br>
    <section>
        <div class="rt-container">
            <div class="col-rt-12 card">
                <div class="Scriptcontent" style="display: flex;">

            

                    
                    <form method="POST" action="{{ url('star/'. $star->id.'/edit') }}" style="width: 50%;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <label for="nom">Nom:</label><br>
                        <input type="text" required name="nom" class="input2" value="{{$star->nom}}" id="nom">
                        <br>
                        <label for="prenom">Prenom:</label><br>
                        <input type="text" required name="prenom" class="input2" value="{{$star->prenom}}" placeholder="prenom" id="prenom">
                        <br>
                        <label for="description">Description:</label><br>
                        <textarea class="textarea2" type="text" required name="description"  placeholder="description" id="description"> {{$star->description}} </textarea>
                        
                        <br>
                        <label for="image">Photo:</label><br>
                        <input type="file" name="image" id="image" >

                        <br>
                        <br>
                        <br>
                        <input type="submit" value="mettre a jour" style="background-color: antiquewhite; border-radius: 20px; width: 150px; height: 30px;">

                    </form>


                    <img src="{{url('storage/'.$star->image)}}" alt="" width="300" height="300">
              
            </div>
        </div>
    </div>
</section>
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