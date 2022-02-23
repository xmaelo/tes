@extends('base')

@section('title', 'Ajout')


@section('content')
<div class="rt-container">
    <div class="col-rt-12">
        <div class="Scriptcontent">
            <form action="/star/store" method="POST" class="form">
                @csrf
                <input type="text" required name="nom" placeholder="nom" id="nom">
                <br>
                <input type="text" required name="prenom" placeholder="prenom" id="prenom">
                <br>
                <textarea type="text" required name="description" placeholder="description" id="description"> </textarea>
                <input type="file" required name="image" id="image">

                <input type="submit" value="soumettre">
            </form>
        </div>
        </div>
        </div>
@endsection
@section('javascript')
    <script>
        $("form").submit(function(event){

            console.log("Submitting form start here", "{{url('storage/')}}");
            event.preventDefault();

            const nom = $('#nom').val()
            const description = $('#description').val()
            const prenom = $('#prenom').val()
            const image =  $("#image")[0].files[0]

            const formData = new FormData();

            formData.append("image", image, image.name);
            formData.append("nom", nom)
            formData.append("description", description)
            formData.append("prenom", prenom)
            formData.append("_token", "{{ csrf_token() }}")

            console.log(formData)
           
            $.ajax({
                url: '/star/store',
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
        });
    </script>
@endsection