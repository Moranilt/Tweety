<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/0f0fe750cb.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src='{{ asset('js/nprogress.js') }}'></script>
    <link rel='stylesheet' href='{{ asset('css/nprogress.css') }}'/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        @if(auth()->guest())
            <section class="px-8 py-4 mb-6 border-b-2 border-gray-600">
                <header class="container mx-auto flex justify-between">
                    <h1>
                        <img src="/images/logo.svg" alt="tweety">
                    </h1>

                </header>
            </section>
        @endif


        {{ $slot }}

    </div>

    <div id="notify-success" style="display:none;background-color: #1d643b; color:#fafafa; padding:10px 30px; font-size:14px; font-weight:bold;position:fixed; bottom:20px;right:20px;">

    </div>
    <div id="notify-error" style="display:none;background-color: #c53030; color:#fafafa; padding:10px 30px; font-size:14px; font-weight:bold;position:fixed; bottom:20px;right:20px;">

    </div>

    <div id="tweet-edit-form" class="relative bg-white shadow-lg border border-gray-100 py-4 px-6" style="display:none; width:350px;position:fixed; left: 50%; transform: translateX(-50%) translateY(-50%);top: 50%;">
        <div id="tweet-edit-form-close" class="absolute p-1 text-gray-600" style="right:20px; top:10px; cursor:pointer;">
            <i class="fas fa-times"></i>
        </div>
        <h3 class="text-2xl font-bold mb-4">Edit tweet</h3>
        <form method="POST">
            @csrf
            <textarea id="tweet-edit-body" class="mb-2 w-full border border-gray-300">

            </textarea>

            <input type="file" name="tweet-edit-photo" class="my-2" id="tweet-photo">

            <img src="#" id="tweet-edit-photo-prev" style="display:none;width:50%;">

            <button
                type="submit"
                class="bg-blue-500 rounded-lg shadow py-2 px-10 text-sm text-white mt-4 hover:bg-blue-600"
            >
                Save
            </button>
        </form>
    </div>


<script>
    // Echo.channel('subscribtion')
    //     .listen('UserFollowed', (e) => {
    //         console.log(e);
    //     });
    var userId = '{{ auth()->user() ? auth()->user()->id : '' }}';
    Echo.private(`user.${userId}`)
        .listen('UserFollowed', (e) => {
            console.log(e);
            succShow(e);
        });

    // Echo.private(`user.${userId}`)
    //     .notification((notification) => {
    //         console.log(notification.type);
    //     });


    Echo.private(`App.User.${userId}`)
        .notification((notification) => {
            console.log(notification.type);
            succShow(notification);

            $('#count-notifications').html(notification.count_notify).show();
        });





    Echo.private(`App.User.${userId}`)
        .listen('MessageSent', (message) => {
            console.log(message);
            //$('#chat').append(showMsg(message));
            $('#chat-frame').load(" #chat", function(){
                $('#chat').scrollTop($('#chat')[0].scrollHeight)
            });

        });

    //Tweet dots (submenu)


    $('.tweet-menu .menu-dots').click(function(){
        let subMenu = $(this).parent().find('.sub-menu')
        subMenu.toggle('fast', 'swing')

        if($(this).find('i').hasClass('fa-ellipsis-h')){
            $(this).find('i').removeClass('fa-ellipsis-h').addClass('fa-times')

        }else if($(this).find('i').hasClass('fa-times')){
            $(this).find('i').removeClass('fa-times').addClass('fa-ellipsis-h')
        }

    });

    $('#tweet-edit-form #tweet-edit-form-close').click(function(){
        $(this).parent().hide()
    })

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.tweet-menu .sub-menu .tweet-edit').click(function(){
            let tweet_id = $(this).attr('data-tweet-id')
            let route = 'tweets/'+tweet_id+'/edit'

            $('#tweet-edit-form').show();
            $(this).parent().parent().toggle()

            if($(this).parent().parent().parent().find('i').hasClass('fa-ellipsis-h')){
                $(this).parent().parent().parent().find('i').removeClass('fa-ellipsis-h').addClass('fa-times')

            }else if($(this).parent().parent().parent().find('i').hasClass('fa-times')){
                $(this).parent().parent().parent().find('i').removeClass('fa-times').addClass('fa-ellipsis-h')
            }

            $.ajax({
                url: route,
                type: "GET",
                data:{
                    tweet_id:tweet_id
                },
                success: function(e){
                    console.log(e)
                    $('#tweet-edit-form').find('#tweet-edit-body').html(e.tweet.body)
                    $('#tweet-edit-form').find('#tweet-edit-photo-prev').show().attr('src', '{{ asset('storage/')}}'+'/'+e.tweet.photo)

                },
                error: function(e){
                    errorShow(e.responseJSON.errors);
                }
            })
        });
    })



    function succShow(message){

        $('#notify-success').fadeIn().html(message.message);
        $('#notify_link').css('color', 'red');
        setTimeout(succHide, 3000);
    }
    function succHide(){
        $('#notify-success').fadeOut();
        $('#notify_link').css('color', 'black');
    }

    function errorShow(message){

        $('#notify-error').fadeIn().html(message);
        setTimeout(errorHide, 3000);
    }
    function errorHide(message){

        $('#notify-error').fadeOut();
    }

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#follow-btn').click(function(e){
            e.preventDefault();
            var username = $('#follow-form #username').val();
            var route = '/profiles/'+username+'/follow';
            console.log(route);

            $.ajax({
                url: route,
                type: "POST",
                data:{
                    username: username
                },
                beforeSend: function(){
                    NProgress.start();
                },
                success:function(e){
                    console.log(e)
                    $('#follow-btn').html(e.btn_msg);

                },
                error: function(e){
                    errorShow(e.responseJSON.errors);
                },
                complete:function(){
                    NProgress.done();
                }
            });
        });

        $('#notify-bell').click(function(){


            if($('#notify-content').hasClass('opened')){
                $('#notify-content').hide();
                $('#notify-content').removeClass('opened');
            }else{
                $('#notify-content').show();
                $('#notify-content').addClass('opened');
                $.ajax({
                    url: '{{ route('notify.show') }}',
                    type: "PATCH",
                    beforeSend: function(){
                        NProgress.start();
                    },
                    success:function(e){
                        console.log(e)
                        $('#count-notifications').hide();
                        $('#notify-content').load(" #notify-refresh");
                    },
                    error: function(e){
                        errorShow(e.responseJSON.errors);
                    },
                    complete:function(){
                        NProgress.done();
                    }
                });
            }


        });

        $('.like-content').click(function(ev){
            ev.preventDefault();
            var tweet_id = $(this).find('.like-tweet-id').val();
            var like_btn = $(this);

            if(like_btn.hasClass('text-blue-500')) {
                like_btn.removeClass('text-blue-500').addClass('text-gray-600');
                like_btn.find('.fa-heart').removeClass('fas').addClass('far');
            }else{
                like_btn.addClass('text-blue-500');
                like_btn.find('.fa-heart').removeClass('far').addClass('fas');
            }

            $.ajax({
                url: '/tweets/'+tweet_id+'/like',
                type: "POST",
                data:{
                    tweet_id: tweet_id
                },
                success:function(e){
                    if(like_btn.hasClass('text-blue-500')){
                        like_btn.find('.like-tweet').text(e.count_likes);
                    }else{
                        like_btn.find('.like-tweet').text(e.count_likes);
                    }

                },
                error:function(e){
                    errorShow(e.responseJSON.errors);
                }
            });
        });

        $('#message_input').keypress(function(e){
            if(e.which == 13){
                e.preventDefault();
                var message = $('#send_chat_form #message_input').val();
                var chat_id = $('#send_chat_form #chat_id').val();

                $.ajax({
                    url:'/chats/'+chat_id+'/send',
                    type: "POST",
                    data:{
                        message:message
                    },
                    success:function(e){
                        $('#send_chat_form')[0].reset();
                        $('#chat-frame').load(" #chat", function(){
                            $('#chat').scrollTop($('#chat')[0].scrollHeight);

                        });
                    },
                    error: function(e){
                        errorShow(e.responseJSON.errors);
                    }
                });
            }
        });

        $('#send-msg').click(function(e){
            e.preventDefault();
            var message = $('#send_chat_form #message_input').val();
            var chat_id = $('#send_chat_form #chat_id').val();

            $.ajax({
                url:'/chats/'+chat_id+'/send',
                type: "POST",
                data:{
                    message:message
                },
                success:function(e){
                    // console.log(e);
                    // $('#chat').append(showYourMsg(e));
                    $('#send_chat_form')[0].reset();
                    $('#chat-frame').load(" #chat", function(){
                        $('#chat').scrollTop($('#chat')[0].scrollHeight);

                    });
                },
                error: function(e){
                    errorShow(e.responseJSON.errors);
                }
            });

        });
    });//document ready end
</script>

</body>
</html>
