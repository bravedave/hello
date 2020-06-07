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
<div id="<?= $_uid = strings::rand() ?>"></div>
<script>
$(document).on( 'todo-refresh', function() {
    $( '#<?= $_uid ?>').html('');

    _brayworth_.post({
        url : _brayworth_.url('<?= $this->route ?>'),
        data : { action : 'todo-get-items' },

    }).then( function( d) {
        if ( 'ack' == d.response) {
            // console.table( d.data);
            $.each( d.data, function( i, el) {
                let row = $('<div class="row form-group" />').appendTo( '#<?= $_uid ?>');
                let col = $('<div class="col" />').appendTo( row);
                let div = $('<div class="form-control delete-cursor" />').html( el.description);

                col
                .data('id', el.id)
                .append( div)
                .on( 'click', function( e) {
                    let _me = $(this);
                    let _data = _me.data();

                    _brayworth_.post({
                        url : _brayworth_.url('<?= $this->route ?>'),
                        data : {
                            action : 'todo-delete-item',
                            id : _data.id

                        },

                    }).then( function( d) {
                        // _brayworth_.growl( d);
                        $(document).trigger('todo-refresh');

                    });

                });

            });

        }
        else {
            _brayworth_.growl( d);

        }

    });

});
</script>
<form id="<?= $_form = strings::rand() ?>">
    <input type="hidden" name="action" value="todo-add-item">
    <div class="row">
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control"
                    name="description"
                    placeholder="todo"
                    autocomplete="off"
                    required />

                <div class="input-group-append">
                    <button class="btn btn-secondary">+</button>

                </div>

            </div>

        </div>

    </div>

</form>
<script>
$('#<?= $_form ?>').on( 'submit', function( e) {
    let _form = $(this);
    let _data = _form.serializeFormJSON();

    _brayworth_.post({
        url : _brayworth_.url('<?= $this->route ?>'),
        data : _data,

    }).then( function( d) {
        _brayworth_.growl( d);
        $('[name="description"]', _form).val('');
        $(document).trigger('todo-refresh');

    });

    return false;

});

$(document).ready( function() {
    $(document).trigger('todo-refresh');

});
</script>