


$(function() {

    $('.lazy').Lazy();

    const shirt = $('.magic-shirt');
    const STORAGE_URL = shirt.attr('data-storage')

    //Preview da t-shirt com a cor selecionada
    $(".magic-color").on('change', function() {
       shirt.attr("src", STORAGE_URL+'/'+$(this).val()+'.jpg');
    });

    //Preview imagem da estampa antes do upload
    $(".estampa-file").change(function(){
        readURL(this);
    });


});
$('body').css('padding-bottom',$('#footer').height()+'px')
$(window).resize(function() {

    $('body').css('padding-bottom',$('#footer').height()+'px')
    if (window.matchMedia('(max-width: 767.98px)').matches) {
       $('.filter-content').removeClass('show')
    }else {
        $('.filter-content').addClass('show')
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.estampa-preview-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}




