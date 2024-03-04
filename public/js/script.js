// sticky header
$(document).ready(function () {
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        if ($(window).width() >= 765) {
            if (scrollTop > 1) {
                $('header').addClass('sticky');
            } else {
                $('header').removeClass('sticky');
            }
        } else {
            if (scrollTop > 55) {
                $('header').addClass('sticky');
            } else {
                $('header').removeClass('sticky');
            }
        }
    });
});

//Dropdown toggle
$(document).ready(function () {
    $(".dropdown").hover(function () {
        var dropdownMenu = $(this).children(".dropdown-menu");
        if (dropdownMenu.is(":visible")) {
            dropdownMenu.parent().toggleClass("open");
        }
    });
});
//Sign up Form tab
$('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
})

// Logo Hide Btn
$(document).on("click",".logo-hide-btn",function () {
		$(this).parent().hide();
	});
$(function(){
  $('#datepicker').datepicker();
});

	// Payment button area start here ***
	$(document).on("click", ".int-btn", function () {
		// Check if the clicked button already has the "active" class
		if ($(this).hasClass("active")) {
			// If it does, remove the "active" class
			$(this).removeClass("active");
		} else {
			// If it doesn't, remove the "active" class from all buttons
			$(".int-btn").removeClass("active");
			// Add the "active" class to the clicked button
			$(this).addClass("active");
		}
	});


// Main Nav
$(document).ready(function ($) {
    $('.stellarnav').stellarNav({
        theme: 'dark',
        breakpoint: 960,
        position: 'right',
        phoneBtn: '312-291-4486',
        locationBtn: ''
    });
});

// Review Slide JS
$('#home-slider').owlCarousel({
    loop: true,
    items: 1,
    margin: 0,
    nav: false,
    dots: true,
    autoplay: true,
    smartSpeed: 1000,
    autoplayHoverPause: true,
    navText: [
        "<i class='flaticon-left-arrow'></i>",
        "<i class='flaticon-right-arrow-1'></i>",
    ],
});

/* ------------------ OWL CAROUSEL ------------------ */

$(".owl-carousel").each(function () {
    var $Carousel = $(this);
    $Carousel.owlCarousel({
        loop: $Carousel.data('loop'),
        autoplay: $Carousel.data("autoplay"),
        margin: $Carousel.data('space'),
        nav: $Carousel.data('nav'),
        dots: $Carousel.data('dots'),
        dotsSpeed: $Carousel.data('speed'),
        center: $Carousel.data('center'),
        thumbs: true,
        thumbsPrerendered: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item',
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: $Carousel.data('slide-res')
            },
            1000: {
                items: $Carousel.data('slide'),
            }
        }
    });
});

$(document).ready(function () {
    // Initialize datepicker
    $('#datepicker').datepicker({
        format: 'm/d/y',  // Specify the date format
        autoclose: true,
        endDate: '0d'  // Disallow future dates
    });
});

// $(document).ready(function () {
//     $('#addImageBtn').click(function () {
//         $('#imageInput').click();
//     });

//     $('#imageInput').change(function () {
//         var selectedFile = this.files[0];
//         console.log(selectedFile);
//     });
// });

$(document).ready(function () {
    $('.clickable-image').click(function () {
        var clickedImageSrc = $(this).attr('src');
        $('#targetImage').attr('src', clickedImageSrc);
    });

    $('#addImageBtn').click(function () {
        $('#imageInput').click();
    });

    $('#imageInput').change(function () {
        var selectedFile = this.files[0];
        var selectedFileName = selectedFile ? selectedFile.name : 'No file selected';
        console.log(selectedFileName);
        $('#selectedImageName').text(selectedFileName);
    });
});


$(document).ready(function () {
    $('.status-cell').on('click', function () {
        var userId = $(this).data('user-id');
        var cellElement = $(this);

        $.ajax({
            url: '/update-status/' + userId,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function (data) {
                if (data.status == '1') {
                    alert('User status is now Active.');
                } else {
                    alert('User status is now Inactive.');
                }

                if (data.status == '1') {
                    cellElement.html('<span class="badge rounded-pill bg-success">Active</span>');
                } else {
                    cellElement.html('<span class="badge rounded-pill bg-danger">Inactive</span>');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            },
        });
    });
});

$(document).ready(function () {
    $('.open-modal').on('click', function () {
        var userId = $(this).data('user-id');

        loadUserImages(userId);
    });

    function loadUserImages(userId) {
        var modalImageGrid = $('#modalImageGrid');
        modalImageGrid.empty();

        $.ajax({
            url: '/user-images/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length > 0) {
                    $.each(data, function (index, image) {
                        var imgElement = $('<img>').attr({
                            src: '/storage/' + image.photo,
                            alt: 'User Image',
                            style: 'width: 150px; height: 150px;'
                        });
                        modalImageGrid.append(imgElement);
                    });
                } else {
                    modalImageGrid.html('<p>No images found for this user.</p>');
                }
            },
            error: function (error) {
                console.error('Error fetching user images:', error);
            }
        });
    }
});





