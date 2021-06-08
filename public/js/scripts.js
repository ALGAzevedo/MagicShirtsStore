

$(function() {

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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.estampa-preview-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}




