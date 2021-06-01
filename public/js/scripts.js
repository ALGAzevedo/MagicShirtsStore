

$(function() {

    $(".quantity").on('change paste input', function() {
        console.log($(this).val())
    });

   /* $("select").on('change', function() {
        $(this).attr("src", "url");
    });*/
});

const magic_color = document.querySelector('.magic-color')
const magic_shirt = document.querySelector('.magic-shirt')
const STORAGE_URL = magic_shirt.getAttribute('data-storage')

magic_color.addEventListener('change', (e)=>{
    magic_shirt.setAttribute('src', STORAGE_URL+'/'+e.target.value+'.jpg');
})
