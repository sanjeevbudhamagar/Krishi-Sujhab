/**
 * Created by sanjeevbudha on 6/30/16.
 */

function deleteBreed(id){

    var mode ='delete';

    var n = noty({
        layout: 'center',
        text: "Are you sure you want delete? ",
        killer: true,
        buttons: [
            {
                addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
                n.close();
                $.ajax({
                    type:"POST",
                    url:'../controller/breedHandler.php',
                    data:"mode="+mode+"&id="+id,
                    success:function(data){
                        var data = JSON.parse(data);

                        if(data.message=='success'){
                            displayMessage("Successfully Deleted","success");
                            customReloadWindow(2000)
                        }
                    },error: function (er) {
                       console.log(er);
                    }
                });
                return false;
            }
            },
            {
                addClass: 'btn btn-danger', text: 'Cancel', onClick: function ($noty) {
                n.close();
            }
            }
        ]
    })

}

function editBreed(id){

    var mode ='edit';

    $.ajax({
        type:"POST",
        url:'../controller/breedHandler.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){
            var data = JSON.parse(data);

            var b_id = data['id'];
            $("#breedName").val(data['breed_name']);
            $("#origin_distribution").val(data['origin_distribution']);
            $("#character").val(data['breed_character']);
            $("#utility").val(data['utility']);
            $("#image").attr('value',data['image']);

            $('#insert-breed').modal('show');
            $('#insert-breed .modal-title').html("प्रजाति परिमार्जन गनुहोस्");
            $('#insert-breed button[type=submit]').html("पेश गर्नुहोस्");
            $('#breed-form').attr('action','../controller/breedHandler.php');
            $('#breed_mode').attr('value','update');
            $('#breed_id').attr('value',b_id);

            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
            });

        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });

    return false;
}
