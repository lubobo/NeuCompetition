/**
 * Created by root on 16-7-30.
 */
$(document).ready(function () {
    //------------------------------共用部分--------------------------------------
    //****************姓名****************************
    $('#name').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { name:$("#name").val(),role:'student',field:'name'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#name+span").remove();
                if(data=='right'){
                    $("#name").after('<span style="color:#2ca02c" class="tip">right</span>')
                }
                else {
                    $("#name").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            error: function(xhr, type){
                alert('Ajax error!');
            }
        });
    });
    //****************邮箱****************************
    $('#email').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#email").val(),role:'student',field:'email'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#email+span").remove();
                if(data=='right'){
                    $("#email").after('<span style="color:#2ca02c" class="tip">right</span>');
                }
                else {
                    $("#email").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            error: function(xhr, type){
                alert('Ajax error!');
            }
        });
    });
    //****************密码******************************
    $('#password').blur(function () {

        $("#password+span").remove();

        var patrn=/\w{6,20}/;
        if(patrn.exec($('#password').val())){
            $("#password").after('<span style="color:#2ca02c" class="tip">right</span>');
        }
        else {
            if($('#password').val()>5&&$('#password').text()<21){
                $("#password").after('<span style="color:red" class="tip">need 6 to 20</span>');
            }
            else {
                $("#password").after('<span style="color:red" class="tip">only (a-z/0-9/_)</span>');
            }
        }
    });
    $('#password_').blur(function () {
        $("#password_+span").remove();
       if($('#password_').val()==$('#password').val()&&$('#password_').val().length>0) {
           $("#password_").after('<span style="color:#2ca02c" class="tip">right</span>');
       }
       else {
           $("#password_").after('<span style="color:red" class="tip">wrong</span>');
       }
    });
    //****************手机号****************************
    $('#phone_num').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#phone_num").val(),role:'student',field:'phone_num'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#phone_num+span").remove();
                if(data!='form is wrong'){
                    $("#phone_num").after('<span style="color:#2ca02c" class="tip">'+data+'</span>');
                }
                else {
                    $("#phone_num").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            error: function(xhr, type){
                alert('Ajax error!');
            }
        });
    });
    //-----------------------------学生-----------------------------
    //**************************学号****************************
    $('#num').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#num").val(),role:'student',field:'num'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#num+span").remove();
                if(data=='right'){
                    $("#num").after('<span style="color:#2ca02c" class="tip">right</span>')
                }
                else {
                    $("#num").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            // error: function(xhr, type){
            //     alert('Ajax error!');
            // }
        });
    });
    //********************************班级**********************
    $('#class').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#class").val(),role:'student',field:'class'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#class+span").remove();
                if(data=='right'){
                    $("#class").after('<span style="color:#2ca02c" class="tip">right</span>')
                }
                else {
                    $("#class").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            error: function(xhr, type){
                alert('Ajax error!');
            }
        });
    });
//**********************************身份号******************************
    $('#cardID').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#cardID").val(),role:'student',field:'cardID'},
            dataType: 'json',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#cardID+span").remove();
                $(".ppp").remove();
                if(data['status']=='right'){
                    $("#cardID").after('<span style="color:#2ca02c;display: none" class="tip" id="ttt" >right</span>');
                    $('#ttt').after('<p class="ppp">地区：'+data['att']+'</p>')
                    $('#ttt').after('<p class="ppp">年份：'+data['born']+'</p>')
                    $('#ttt').after('<p class="ppp">性别：'+data['sex']+'</p>')
                }
                else {
                    $("#cardID").after('<span style="color:red" class="tip">'+data['status']+'</span>')
                }
            },
            error: function(xhr, type){
                alert('Ajax error!');
            }
        });
    });
    //-----------------------------老师-----------------------------
    //**************************工资号****************************
    $('#num_tea').blur(function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: { value:$("#num_tea").val(),role:'teacher',field:'num'},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#num_tea+span").remove();
                if(data=='right'){
                    $("#num_tea").after('<span style="color:#2ca02c" class="tip">right</span>')
                }
                else {
                    $("#num_tea").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            // error: function(xhr, type){
            //     alert('Ajax error!');
            // }
        });
    });
    //****************姓名****************************
    $('#team_name').blur(function () {
        $.ajax({
            type: 'POST',
            url: $('meta[name="url"]').attr('content'),
            data: { name:$("#team_name").val()},
            dataType: 'text',
            // headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                $("#team_name+span").remove();
                if(data=='nice'){
                    $("#team_name").after('<span style="color:#2ca02c" class="tip">nice</span>')
                }
                else {
                    $("#team_name").after('<span style="color:red" class="tip">'+data+'</span>')
                }
            },
            // error: function(xhr, type){
            //     alert('Ajax error!');
            // }
        });
    });

    //***********************团队**************************************
//--------------------------提交----------------------------------------
    $('#btn').click(function () {

        //-------问题代码------
        $('#num,#num_tea,#team_name').trigger('blur');
        //因为一直无法解决浏览器返回页面不刷新，而导致可能出现统一学号注册多次的情况
        //因此不得不引用上句，与此同时抹掉了其AJAX操作的error部分

        var name=$('#name +span').text();
        var num=$('#num +span').text();
        var class_=$('#class +span').text();
        var cardID=$('#cardID +span').text();
        var email=$('#email +span').text();
        var phone_num=$('#phone_num +span').text();
        var password=$('#password_ + span').text();

        var num_tea=$('#num_tea +span').text();

        var team_name=$('#team_name +span').text();
        ok=name=='right'&&email=='right'&&phone_num!='form is wrong'&&password=='right'&&((num=='right'&&cardID!='cardID is wrong'&&class_=='right')||(num_tea=='right'))||team_name=='nice';
        if(ok){
            $('#form').submit();
            // alert('123');
        }
        else {
            $('#name,#num,#email,#phone_num,#cardID,#class,#num_tea,#subject,#password,#password_').trigger('blur');
            }
    });
});