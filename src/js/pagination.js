// Update pagination
function update_pagination(current, max, table, condition, file) {
    $.ajax({
        url: file,
        method: 'POST',
        data: {current:current, max:max, table:table, condition:condition},
        success: function(data) {
            $('.pagination').html(data);
        }
    });
}