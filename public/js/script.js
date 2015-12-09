$(document).ready(function(){

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    setSizes();
    $(window).resize(function() {
        setSizes();
    });
});

/**
 * Boîte de suppression
 */
$('body').on('click', '.delete-confirm', function(e) {
    var deleteConfirm = $(this);
    e.preventDefault();
    sweetAlert({   title: 'Confirmation',   text: 'Êtes vous sûr de vouloir supprimer cet élément ? Cette action est irréverssible',   type: 'warning',   showCancelButton: true,   confirmButtonColor: "#02c66c", cancelButtonText: 'Non', confirmButtonText: 'Oui',   closeOnConfirm: false, closeOnCancel: true, showLoaderOnConfirm: true,
    }, function()
    {
        $.ajax({
            url: deleteConfirm.attr('data-href'),
            type: 'DELETE',
            dataType: 'JSON',
            data: {
                _token: $('input[name="_token"]').val(),
                id: deleteConfirm.attr('data-id'),
            },
            success: function(data) {
                if( data.status == 'success' ) {
                    $('#' + data.id).fadeOut();
                    sweetAlert('Supprimé !', data.message, 'success');
                } else {
                    sweetAlert('Oups...', data.message, 'error');
                }
            },
            error: function(data) {
                sweetAlert('Oups...', 'Une erreur est survenue', 'error');
                console.log(data);
            }
        });
    });
});

/**
 * Ajout d'une nouvelle activité
 */
$('.submit-activity').on('click', function (e) {
    e.preventDefault();
    submitActivity($('.activity-form'), false);
});

/**
 * Edition d'une activité
 */
$('.timeline-2').on('click', '.edit-form', function(e){
    e.preventDefault();
    var content =  $('#content_' + $(this).attr('data-id'));
    var form =  content.parent().find('.form-edit');

    content.toggleClass('hidden');
    form.toggleClass('show');

    $('.activity-edit-submit').on('click', function(e) {
        e.preventDefault();
        submitActivity(form, true);
    })
});

/**
 * Type de publication
 */
$('.post-type').on('click', function(e) {
    e.preventDefault();
    var dataType = $(this).attr('data-type');
    $('.post-type').each(function() {
        $(this).removeClass('disabled');
    });
    $(this).addClass('disabled');
});

/**
 * Soumission du commentaire
 */
$('#modal').on('click', '.submit-comment', function(e){
    e.preventDefault();
    var form = $('.submit-comment').parents('form');
    submitComment(form, false)
});

$('body').on('dblclick', '.comment', function(e) {
    e.preventDefault();

    var commentId = $(this).attr('id');
    var formEdit = $('#comment_' + commentId).find('.form-comment-edit');
    var comment = $('#' + commentId);
    $('#' + commentId).hide();
    formEdit.show();

    mouseExit(formEdit, comment);
    formEdit.on('click', '.submit-edit-comment', function(e) {
        e.preventDefault();
        submitComment(formEdit, true);
    });
});

/**
 * Affichage des commentaires
 */
$('.timeline-2').on('click', '.get-comments', function(e) {
    e.preventDefault();
    displayModalData($(this), 'Commentaires');
});

/**
 * Nettoyage du modal à sa fermeture
 */
$('#modal').on('hidden.bs.modal', function () {
    $(this).find('.modal-title').text('');
    $(this).find('.modal-body').html('');
});

/**
 * ----------------------------------------------
 * ------------ Functions AJAX ------------------
 * ----------------------------------------------
 */

/**
 * Soumission d'une activité
 * @param form
 * @param edit
 */
function submitActivity(form, edit) {

    var formGroup = form.find('.form-group');
    var textarea = formGroup.children('textarea');

    if( formGroup.hasClass('has-error') ) {
        formGroup.removeClass('has-error');
        formGroup.find('.block-helper').remove();
    }

    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {
            if( edit ) {
                var activity =  $('#activity_' + data.id);
                var form =  activity.find('.form-edit');
                var content = activity.find('#content_' + data.id);
                content.empty().text(data.content);
                content.removeClass('hidden').addClass('show');
                form.removeClass('show').addClass('hidden');
                form.find('textarea').val('');
            } else {
                textarea.val('');
                $('.timeline-2').children('li').eq(0).after(data);
            }
        },
        error: function (data) {
            formGroup.addClass('has-error');
            textarea.after("<span class=\"block-helper text-danger\">" +
                data.responseJSON.content + "</span>");
        }
    });
}

/**
 * Permet de soumettre un commentaire
 * @param form
 * @param edit
 */
function submitComment(form, edit) {
    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function(data) {
            var comments = $('#modal .modal-dialog .modal-content .modal-body .comments');
            if( edit ) {
                comments.find('#' + data.id).empty().text(data.comment).show();
                form.hide();
            } else {
                form.find('textarea').val('');
                //comments.append(data);
                comments.find('.no-comment').remove();
                comments.append(data);
            }
        },
        error: function (data) {
            form.find('.form-group').eq(0).addClass('has-error');
            form.find('textarea').after("<span class=\"block-helper text-danger\">" +
                data.responseJSON.content + "</span>");
        }
    });
}

/**
 * Affiche du html récupéré en Ajax dans un modal
 * @param target
 */
function displayModalData(target, title) {
    $.ajax({
        method: 'GET',
        url: target.attr('href'),
        success: function(html) {
            var modal = $('#modal');
            modal.find('.modal-title').text(title);
            modal.find('.modal-body').html(html);
            modal.modal('show');
        }
    });
}

/**
 * ----------------------------------------------
 * ------------ Functions -----------------------
 * ----------------------------------------------
 */

/**
 * Cache un élément lors d'un clic extérieur à la zone
 * et en affiche un autre si renseigné
 * @param hide
 * @param display
 */
function mouseExit(hide, display) {
    $(document).on('mouseup', function(e) {

        if( !hide.is(e.target) && hide.has(e.target).length === 0 ) {
            hide.hide();
            if( display != 'undefined' ) {
                display.show();
            }
        }

    });
}

/**
 * Ajustement de la taille de la fenêtre
 */
function setSizes()
{
    $('.boxed').css({'min-height': $(window).height() - ($('#footer').innerHeight()) + 'px'});
}