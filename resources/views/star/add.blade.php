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
                <div class="Scriptcontent">
                    <form action="/star/store" method="POST" class="form">
                        @csrf
                        <label for="nom">Nom:</label><br>
                        <input type="text" required name="nom" id="nom" class="input"><br>
                        <label for="prenom">Prenom:</label><br>
                        <input type="text" required name="prenom" id="prenom" class="input">
                        <br>
                        <label for="description">Description:</label><br>
                        <textarea type="text" required name="description" placeholder="description" id="description"> </textarea>
                        <br>
                        <label for="image">Photo:</label><br>
                        
                        <input type="file" required name="image" id="image">
                        <br>
                        <br>
                        <br>
                        <input type="submit" value="soumettre" style="background-color: antiquewhite; border-radius: 20px; width: 150px; height: 30px;">
                    </form>
                </div>
            </div>
        </div>
    </section>
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