<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/  ?>

<style>
.delete-cursor { cursor: url(<?= strings::url( 'images/delete-cursor.png') ?>), auto; }
</style>
<div id="<?= $_uid = strings::rand() ?>" class="mb-2"></div>
<form id="<?= $_form = strings::rand() ?>">
    <input type="hidden" name="action" value="todo-add-item">
    <div class="form-group row">
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control" name="description"
                    placeholder="todo" autocomplete="off" required />

                <div class="input-group-append">
                    <button class="btn btn-secondary">+</button>

                </div>

            </div>

        </div>

    </div>

</form>
<script>
((_) => {
    $(document).on( 'todo-refresh', () => {
        $( '#<?= $_uid ?>').html('');

        _.post({
            url : _.url('<?= $this->route ?>'),
            data : { action : 'todo-get-items' },

        }).then( (d) => {
            if ( 'ack' == d.response) {
                if ( d.data.length > 0) {
                    $( '#<?= $_uid ?>').html('<h6 class="mx-2 mt-2 mb-0">Todo..</h6>');
                    let ul = $('<ul class="list-group"></ul>').appendTo( '#<?= $_uid ?>');

                    $.each( d.data, ( i, el) => {
                        $('<li class="list-group-item delete-cursor"></li>')
                        .data('id', el.id)
                        .html( el.description)
                        .on( 'click', function( e) {
                            let _me = $(this);
                            let _data = _me.data();

                            _.post({
                                url : _.url('<?= $this->route ?>'),
                                data : {
                                    action : 'todo-delete-item',
                                    id : _data.id

                                },

                            }).then( ( d) => {
                                $(document).trigger('todo-refresh');

                            });

                        })
                        .appendTo( ul);

                    });

                }

            } else { _.growl( d); }

        });

    });

    $('#<?= $_form ?>').on( 'submit', function( e) {
        let _form = $(this);
        let _data = _form.serializeFormJSON();

        _.post({
            url : _.url('<?= $this->route ?>'),
            data : _data,

        }).then( function( d) {
            _.growl( d);
            $('[name="description"]', _form).val('');
            $(document).trigger('todo-refresh');

        });

        return false;

    });

})( _brayworth_);

$(document).ready( () => { $(document).trigger('todo-refresh'); });
</script>