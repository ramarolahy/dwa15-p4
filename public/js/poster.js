$(document).ready(function () {
    $('#background-carousel').on('slide.bs.carousel', function (e) {
        const $e = $(e.relatedTarget);
        const idx = $e.index();
        const itemsPerSlide = 4;
        const totalItems = $('.carousel-item').length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            const it = itemsPerSlide - (totalItems - idx);
            for (let i = 0; i < it; i++) {
                // append slides to end
                if (e.direction === "left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                } else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });

    $('input[name="selectedBg"]').on('change', function (evt) {
        const background = $(evt.target).val();
        $('#myQuote').css('background-color', `transparent`).css('background-image', `url('../images/backgrounds/${background}')`)
        html2canvas(document.getElementById("myQuote")).then(canvas => {
            document.getElementById("quoteImg").innerHTML = '';
            document.getElementById("quoteImg").appendChild(canvas);
            const fileElement = document.getElementById('file');
            if (fileElement) {
                fileElement.value = canvas.toDataURL("image/png");
            }
        })
    });
});
