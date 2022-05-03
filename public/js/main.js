var url = 'http://proyecto-laravel.com.devel';

window.addEventListener("load", function(){
    
    function like(){

        $('.btn btn-outline-warning bi bi-star').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn btn-warning bi bi-star').removeClass('btn btn-outline-warning bi bi-star');
            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response);
                }
            });
        })

        dislike();

    }

    function dislike(){

        $('.btn btn-warning bi bi-star').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn btn-outline-warning bi bi-star').removeClass('btn btn-warning bi bi-star');
            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response);
                }
            });
        })

        like();

    }

    // BUSCADOR
    $('#buscador').submit(function(e) {
        $(this).attr('action',url+'/users/'+$('#buscador #search').val());

    });
    
});
