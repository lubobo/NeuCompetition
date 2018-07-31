/**
 * Created by root on 16-8-8.
 */
$(document).ready(function () {
    $('#college').change(function () {
        $.ajax({
            type: 'POST',
            url: $('meta[name="process_url"]').attr('content'),
            data: { college : $("#college option:selected").text()},
            dataType: 'json',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data) {
                $(".initial_tea,.other_tea").remove();
                // $("#college").after("<p id='p_major'><lable>专业：</lable><select id='major' name='major_name'></select></p>");
                for(var i=0; i<data.length;i++){
                    $("#form").prepend('<p class="other_tea"><label>'+data[i][0]+"老师"+'</label><input type="radio" name="teacher_num" value='+data[i][1]+'></p>');
                }
            },
            error: function(xhr, type){
                alert(type);
            }
        });
    });
});
