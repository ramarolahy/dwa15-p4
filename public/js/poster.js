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

    /**
     * Method to call html2canvas and render poster image onto canvas
     */
    const renderImage = () => {
        html2canvas(document.getElementById("myQuote")).then(canvas => {
            document.getElementById("quoteImg").innerHTML = '';
            document.getElementById("quoteImg").appendChild(canvas);
            const fileElement = document.getElementById('file');
            if (fileElement) {
                fileElement.value = canvas.toDataURL("image/png");
            }
        })
    };
    /**
     * Handles background selection and shows preview on poster
     */
    $('input[name="background"]').on('change', function (evt) {
        const background = $(evt.target).val();
        const background_id = $(evt.target).data('id');
        $('#myQuote').css('background-color', `transparent`).css('background-image', `url('../images/backgrounds/${background}')`);
        $('#background_id').attr('value', `${background_id}`);
       renderImage();
    });
    /**
     * Handles design selection and shows preview on poster
     */
    $('input[name="design"]').on('change', function (evt) {
        const design = $(evt.target).val();
       $('#quotePoster').removeClass (function (index, className) {
           return (className.match (/(^|\s)design_\S+/g) || []).join(' ');
       }).addClass(`${design}`);
       $('#design').attr('value', `${design}`);
        renderImage();
    });
});
