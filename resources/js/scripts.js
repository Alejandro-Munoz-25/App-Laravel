const url_base = "https://laravel-app-laragram.herokuapp.com/";

// Cargar dark theme
let htmlClasses = document.querySelector('html').classList;

document.getElementById('switchTheme').addEventListener('click', function () {
    if (localStorage.theme == 'dark') {
        htmlClasses.remove('dark');
        htmlClasses.remove('duration-700');
        localStorage.removeItem('theme')
    } else {
        htmlClasses.add('dark');
        htmlClasses.add('duration-700');
        localStorage.theme = 'dark';
    }
});

// Cargar imagen seleccionada
loadFile = function (event) {

    var image = document.getElementById('img');
    var label = document.getElementById('imgSelected');

    image.src = URL.createObjectURL(event.target.files[0]);

    if (event.target.files[0].type.includes('image')) {
        image.classList.remove("hidden");
        label.classList.remove("hidden");
        label.textContent = "Selected image";
    } else {
        label.textContent = "Please select an image";
        image.classList.add("hidden");

    }
};

// Scroll Infinito
var page = 1;
const pagelikes = window.location.origin + "/";
const pagehome = window.location.origin + "/likes";
const pageProfiles = window.location.origin + "/profiles";
var pageProfilesSe = window.location.origin + "/profiles/" + $('#search #input-search').val();
var canLoad = window.location.href == pagelikes || window.location.href == pagehome || window.location.href == pageProfiles || window.location.href == pageProfilesSe ? true : false;

$(window).on('scroll', infiniteScroll);
$(window).on('touchmove', infiniteScroll);

function infiniteScroll() {
    if ($(document).scrollTop() >= $(document).height() - window.innerHeight - 200 && canLoad) {
        canLoad = false;
        ++page
        loadMoreData(page);
        // page = (lastPage >= page) ? ++page : 0; //!Scroll infinito
    }
}

function loadMoreData(page) {

    $.ajax({
        url: '?page=' + page,
        type: "get",
        beforeSend: function () {
            $('.ajax-load').show();
        }
    })
        .done(function (data) {
            // console.log(data);
            if (data.html == "" || data.lastPage < page) {
                $('.ajax-load').html("<p class='dark:text-white'>No more records found</p>");
                return;
            }
            setTimeout(() => {
                $('.ajax-load').hide();
                $("#post-data").append(data.html);
                canLoad = true;
            }, 1000);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('Server Not Responding...');
        });
}


//funcion para comprobacion entre like y dislike
likes = function (element) {

    if ($(element).hasClass("like")) {

        $(element).addClass('dislike dark:text-gray-200').removeClass('like fill-current text-red-500')


        $.ajax({
            url: url_base + 'dislike/' + $(element).data('id'),
            type: 'GET',
            success: function (response) {
                updateCountLikes(response, element, 'dislike');
            }
        }
        )
    } else {

        $(element).addClass('like fill-current text-red-500').removeClass('dislike dark:text-gray-200')

        $.ajax({
            url: url_base + 'like/' + $(element).data('id'),
            type: 'GET',
            success: function (response) {
                updateCountLikes(response, element, 'like');
            }
        })

    }

}

// Actualizar likes
function updateCountLikes(response, element, mensaje) {
    if (response.like) {
        $('#likes_' + $(element).data('id')).text(response.count + ' Likes');
    } else {
        console.log('Error=> ' + mensaje);
    }
}

// Search
search = function (form) {
    var search = $('#search #input-search').val();
    $(form).attr('action', url_base + 'profiles/' + search.toLowerCase());
}

// Modals

openModal = function (value) {
    var modal_overlay = document.querySelector('#modal_overlay');
    var modal = document.querySelector('#modal');
    const modalCl = modal.classList
    const overlayCl = modal_overlay

    if (value) {
        overlayCl.classList.remove('hidden')
        setTimeout(() => {
            modalCl.remove('opacity-0')
            modalCl.remove('-translate-y-full')
            modalCl.remove('scale-150')
        }, 100);
    } else {
        modalCl.add('-translate-y-full')
        setTimeout(() => {
            modalCl.add('opacity-0')
            modalCl.add('scale-150')
        }, 100);
        setTimeout(() => overlayCl.classList.add('hidden'), 300);
    }
}

openModalComment = function (value, id) {
    var modal_overlay_id = document.querySelector('#modal_overlay_' + id);
    var modal_id = document.querySelector('#modal_' + id);
    const modalCl_id = modal_id.classList
    const overlayCl_id = modal_overlay_id

    if (value) {
        overlayCl_id.classList.remove('hidden')
        setTimeout(() => {
            modalCl_id.remove('opacity-0')
            modalCl_id.remove('-translate-y-full')
            modalCl_id.remove('scale-150')
        }, 100);
    } else {
        modalCl_id.add('-translate-y-full')
        setTimeout(() => {
            modalCl_id.add('opacity-0')
            modalCl_id.add('scale-150')
        }, 100);
        setTimeout(() => overlayCl_id.classList.add('hidden'), 300);
    }
}
