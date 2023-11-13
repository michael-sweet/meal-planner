$(document).ready(function () {
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2500);

    $('.js-select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });
});

$('.js-modal-confirm').click((e) => {
    e.preventDefault();

    let $form = $(e.target).parent('form');
    let title = $(e.target).data('modal-title');
    let body = $(e.target).data('modal-body');
    let action = $(e.target).data('modal-action') ?? 'OK';
    let action_class = $(e.target).data('modal-action-class') ?? 'btn-primary';

    $('#confirm_modal .js-modal-title').text(title);
    $('#confirm_modal .js-modal-body').html(body);
    $('#confirm_modal .js-submit-btn').text(action);
    $('#confirm_modal .js-submit-btn').removeClass((i, name) => {
        return (name.match(/\bbtn-\S*/g) || []).join(' ');
    });
    $('#confirm_modal .js-submit-btn').addClass(action_class);

    $('#confirm_modal').modal('show');

    $('#confirm_modal .js-submit-btn').off('click').on('click', function() {
        $form.submit();
        $('#confirm_modal').modal('hide');
    });
});

window.switchTheme = function(theme_color) {
    document.getElementById('theme-stylesheet').setAttribute('href', '/css/app_' + theme_color + '.css');
    document.cookie = "theme=" + theme_color + "; path=/";
}
