/**
 * Created by root on 16-7-30.
 */
    $(document).ready(function () {
        $('#college').change(function () {
            $.ajax({
                type: 'POST',
                url: '/register/get_major',
                data: { college : $("#college option:selected").text()},
                dataType: 'json',
                // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    $("#p_major").remove();
                    $("#college").after("<h5 id='p_major'>专业：<select class='form-control' id='major' name='major_name'></select></h5>");
                    for(var i=0; i<data.length;i++){
                        $("#major").append('<option>'+data[i]+'</option>');
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!');
                }
            });
        });
    });