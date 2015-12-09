var WebCoding;

WebCoding = {

    init: function () {
        this.Basic.init();
        this.Components.init();
        this.Actions.init();
        this.Ajax.init();
    },

    Basic: {
        init: function () {
            this.setSizes();
            this.backgrounds();
            this.ajaxLoader();
        },

        /**
         * Hauteur de page pour le footer
         */
        setSizes: function () {
            $('.boxed').css({'min-height': $(window).height() - ($('#footer').innerHeight()) + 'px'});
        },

        /**
         * Exécute une action quand l'utilisateur sort la souris d'une div
         * et en affiche une autre si renseignée
         * @param target
         * @param display
         */
        mouseExit: function (hide, display) {
            $(document).on('mouseup', function (e) {

                if (!hide.is(e.target) && hide.has(e.target).length === 0) {
                    hide.hide();
                    if (display != 'undefined') {
                        display.show();
                    }
                }

            });
        },

        /**
         * Remplace les images src par des images backgrounds
         */
        backgrounds: function () {
            $('.bg-image').each(function () {
                var src = $(this).children('img').attr('src');
                $(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

		/**
         * Ajax Loader et Ajax Modal
         */
        ajaxLoader: function() {

            var toLoad;
            var offsetTop;

            var $ajaxLoader = $('#ajax-loader');
            var $ajaxModal = $('#ajax-modal');
            var isAjaxModal = false;

			/**
             * Affiche l'ajax modal box (custom css)
             */
            function showNewContent() {
                $ajaxModal.fadeIn(200, function(){
                    $('html').addClass('locked-scrolling');
                });
            }

			/**
             * Charge le contenu de la modal box
             */
            function loadContent() {
                $ajaxModal.load(toLoad);
                $('#back-top').fadeOut(200);
            }

            $('body').on('click', '[data-target="ajax-modal"]', function() {
                isAjaxModal = true;
                offsetTop = $(document).scrollTop();
                toLoad = $(this).attr('href');
                loadContent();
                $('body').addClass('ajax-modal-opened');
                return false;
            });

            $(document).ajaxStart(function() {
                if(isAjaxModal) {
                    $ajaxLoader.fadeIn(200);
                }
            });
            $(document).ajaxStop(function() {
                if(isAjaxModal) {
                    $ajaxLoader.fadeOut(200, function(){
                        showNewContent();
                    });
                }
            });
            $(document).ajaxError(function() {
                if(isAjaxModal) {
                    $ajaxLoader.fadeOut(200);
                }
            });

			/**
             * Ferme l'ajax modal box
             */
            function closeDetails() {
                isAjaxModal = false;
                $('html').removeClass('locked-scrolling');
                $('body').removeClass('ajax-modal-opened');
                $(document).scrollTop(offsetTop);
                $ajaxModal.fadeOut(200);
                $('#back-top').fadeIn(200);
            }

            $ajaxModal.delegate('*[data-dismiss="close"]','click', function(){
                closeDetails();
                return false;
            });

        },
    },

    Components: {
        init: function () {
            this.modal();
        },

        /**
         * Boîtes de modals
         */
        modal: function () {

            $('.modal').on('show.bs.modal', function () {
                $('body').addClass('modal-opened');
            });

            $('.modal').on('hide.bs.modal', function () {
                $('body').removeClass('modal-opened');
            });

            $('#mapModal').on('shown.bs.modal', function () {
                google.maps.event.trigger(map, 'resize');
            });
        },
    },

    Actions: {
        init: function () {
            this.submitActivity();
            this.editActivity();
            this.submitComment();
            this.editComment();
            this.choseActivityType();
        },

        /**
         * Soumission d'une nouvelle activité
         */
        submitActivity: function () {
            $('.submit-activity').on('click', function (e) {
                e.preventDefault();
                WebCoding.Ajax.submitActivityData($('.activity-form'), false);
            });
        },

        /**
         * Edition d'une activité
         */
        editActivity: function () {
            $('.timeline-2').on('click', '.edit-form', function (e) {
                e.preventDefault();
                var content = $('#content_' + $(this).attr('data-id'));
                var form = content.parent().find('.form-edit');

                content.toggleClass('hidden');
                form.toggleClass('show');

                $('.activity-edit-submit').on('click', function (e) {
                    e.preventDefault();
                    WebCoding.Ajax.submitActivityData(form, true);
                })
            });
        },

		/**
         * Choix du type d'activité à publier
         */
        choseActivityType: function() {
            $('.post-type').on('click', function(e) {
                e.preventDefault();
                var dataType = $(this).attr('data-type');
                $('.post-type').each(function() {
                    $(this).removeClass('disabled');
                });
                $(this).addClass('disabled');
            });
        },

        /**
         * Soumission d'un nouveau commentaire
         */
        submitComment: function () {
            $('#ajax-modal').on('click', '.submit-comment', function (e) {
                e.preventDefault();
                var form = $('.submit-comment').parents('form');
                WebCoding.Ajax.submitCommentData(form, false);
            });
        },

        /**
         * Edition d'un commentaire
         */
        editComment: function () {
            $('#ajax-modal').on('dblclick', '.comment', function (e) {
                e.preventDefault();

                var commentId = $(this).attr('id');
                var formEdit = $('#comment_' + commentId).find('.form-comment-edit');
                var comment = $('#' + commentId);
                $('#' + commentId).hide();
                formEdit.show();

                WebCoding.Basic.mouseExit(formEdit, comment);
                formEdit.on('click', '.submit-edit-comment', function (e) {
                    e.preventDefault();
                    WebCoding.Ajax.submitCommentData(formEdit, true);
                });
            });
        }

    },

    Ajax: {
        init: function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            this.deleteConfirm();
        },

        /**
         * Boîte de suppression
         */
        deleteConfirm: function () {
            $('body').on('click', '.delete-confirm', function (e) {
                var deleteConfirm = $(this);
                e.preventDefault();
                sweetAlert({
                    title: 'Confirmation',
                    text: 'Êtes vous sûr de vouloir supprimer cet élément ? Cette action est irréverssible',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#02c66c",
                    cancelButtonText: 'Non',
                    confirmButtonText: 'Oui',
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true,
                }, function () {
                    $.ajax({
                        url: deleteConfirm.attr('data-href'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            id: deleteConfirm.attr('data-id'),
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                $('#' + data.id).fadeOut();
                                sweetAlert('Supprimé !', data.message, 'success');
                            } else {
                                sweetAlert('Oups...', data.message, 'error');
                            }
                        },
                        error: function (data) {
                            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
                            console.log(data);
                        }
                    });
                });
            });
        },

        /**
         * Envoie des données AJAX pour une activité
         * @param form  id
         * @param edit  boolean
         */
        submitActivityData: function (form, edit) {
            var formGroup = form.find('.form-group');
            var textarea = formGroup.children('textarea');

            if (formGroup.hasClass('has-error')) {
                formGroup.removeClass('has-error');
                formGroup.find('.block-helper').remove();
            }

            $.ajax({
                method: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    if (edit) {
                        var activity = $('#activity_' + data.id);
                        var form = activity.find('.form-edit');
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
        },

        /**
         * Envoi des données Ajax pour un commentaire
         * @param form  id
         * @param edit  boolean
         */
        submitCommentData: function (form, edit) {
            $.ajax({
                method: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    var comments = $('#ajax-modal .section .container .comments');
                    if (edit) {
                        comments.find('#' + data.id).empty().text(data.comment).show();
                        form.hide();
                    } else {
                        var linkComs = $('#activity_' + comments.attr('data-activity')).find('.panel-footer .get-comments');
                        var countComs = linkComs.find('.total-coms');
                        var countComsTotal = parseInt(countComs.text()) + 1;

                        form.find('textarea').val('');
                        comments.find('.no-comment').remove();
                        comments.append(data);
                        countComs.empty().text(countComsTotal);
                    }
                },
                error: function (data) {

                    $('#ajax-loader').fadeOut();
                    console.log(data);

                    form.find('.form-group').eq(0).addClass('has-error');
                    if( data.responseJSON != 'undefined' ) {
                        form.find('textarea').after("<span class=\"block-helper text-danger\">" +
                            data.responseJSON.content + "</span>");
                    }
                }
            });
        },
    }
};

$(document).ready(function() {
    WebCoding.init();
});

$(window).resize(function() {
    WebCoding.Basic.setSizes();
});