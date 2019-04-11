var url = 'http://instagram.la:8080';
window.addEventListener('load',function(){
//    alert('pagina cargada');
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    function like(){
        console.log('Like');
        $('.btn-like').unbind( "click" );
        $('.btn-like').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){

                    }else{

                    }
                }
            });

            dislike();
        });
    }
    like();

    function dislike(){
        console.log('Dislike');
        $('.btn-dislike').unbind( "click" );
        $('.btn-dislike').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){

                    }else{

                    }
                }
            });

            like();
        });
    }
    dislike();

    $('#buscar_personas').submit(function(){
        $(this).attr('action', url+'/personas/'+$('#busqueda').val());
    });
});