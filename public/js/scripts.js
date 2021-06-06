

$(function() {

    $(".quantity").on('change paste input', function() {
        console.log($(this).val())
    });

   /* $("select").on('change', function() {
        $(this).attr("src", "url");
    });*/
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

$(".estampa-file").change(function(){
    readURL(this);
});

//div.classList.contains('class');
const magic_color = document.querySelector('.magic-color')
const magic_shirt = document.querySelector('.magic-shirt')
const STORAGE_URL = magic_shirt.getAttribute('data-storage')

magic_color.addEventListener('change', (e)=>{
    magic_shirt.setAttribute('src', STORAGE_URL+'/'+e.target.value+'.jpg');
})
