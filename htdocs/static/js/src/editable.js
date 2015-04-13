var Editable = {
    field: function (type, action, content, id, deletable) {
        $field = $("<div/>")
            .attr('data-editable', action)
            .attr('data-field', 'text');
        $content = $("<" + type + "/>").addClass('fieldContent').html(content);
        $field.append($content);
        if (deletable === undefined || deletable) {
            $content = $("<div/>").addClass('fieldDelete').html('<span class="icon-trash"></span>');
            $field.append($content);
        }

        if (!id) {
            $field.attr('data-new', 'true');
        } else {
            $field.attr('data-id', id);
        }
        return $field;
    }

};

$(document).ready(function () {
    $('body').on('click', '[data-editable] .fieldDelete', function (e) {
        $this = $(this);
        $form = $this.parent();
        id = $form.data('id');
        action = $form.data('editable');
        if (id) {
            Api.call(action + '/delete', {id: id});
        }
        $form.remove();
        e.stopPropagation();
    });

    $('body').on('click', '[data-editable]', function () {
        $this = $(this);
        $content = $this.find('.fieldContent');
        $delete = $this.find('.fieldDelete');

        if (!$content.is(":visible")) {
            return;
        }
        $form = $("<form/>")
            .addClass('editable')
            .attr('data-action', $this.data('editable'));
        if ($this.attr('data-new')) {
            $form.attr('data-new', 'true');
        } else {
            $form.attr('data-id', $this.data('id'));
        }
        $content.addClass('hidden');
        $delete.addClass('hidden');
        $content = $("<input/>").attr('type', 'text').attr('name', 'content').val($content.html());
        $form.append($content);
        $this.append($form);
        $content.focus();
    });

    $('body').on('submit', 'form.editable', function () {
        var $this = $(this);
        data = Form.data($this);
        action = $this.data('action');
        id = $this.data('id');
        var isNew = $this.attr('data-new');
        if (!isNew) {
            data.id = $this.data('id');
        }
        var $oldField = $this.parent().find('.fieldContent');
        var $delete = $this.parent().find('.fieldDelete');

        $oldField.html(data.content);
        $oldField.removeClass('hidden');
        if (!isNew) {
            $delete.removeClass('hidden');
        }
        // js query
        Api.call(action + '/add', data, function (data) {
            if (isNew) {
                $oldField.parent().attr('data-id', data.id);
                $oldField.parent().removeAttr('data-new');
                $delete.removeClass('hidden');
            }
        }, function () {
        });
        $this.remove();
        return false;
    });
})
;