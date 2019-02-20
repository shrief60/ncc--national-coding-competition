$('.select_idea_div').click(function () {

    let $this = $(this);

    let idea = $this.attr('data-idea');

    $('#selected-idea').val(idea);

    $this.addClass('border_active').removeClass('border_native');

    $this.find('img.selected').show();

    $this.find('img.not-selected').hide();

    let $siblings = $this.siblings('.select_idea_div');

    $siblings.removeClass('border_active').addClass('border_native');

    $siblings.find('img.selected').hide();

    $siblings.find('img.not-selected').show();
});


$('.main_round_selection .nextStep').click(function () {

    let selectedIdea = $('#selected-idea').val();

    if (!selectedIdea) {
        selectedIdea = $('.select_idea_div.border_active').attr('data-idea');
    }

    axios.post(`/round/ideas/${selectedIdea}`)
        .then(response => {

            const {
                idea,
                route
            } = response.data;
            $('.idea').find('.ideaDescription').text(idea.description);
            $('.idea').find('form').attr('action', route);
            $('.main_round_selection').fadeOut(() => {
                $('.idea').fadeIn();
            });
        })

});
