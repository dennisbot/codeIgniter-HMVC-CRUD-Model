$(function() {
    bootbox.setDefaults({locale: 'es'});
    $('.delete-record').click(function() {
        var that  = this;
        bootbox.confirm('<center><h3>¿Estás seguro de eliminar este registro?</h3></center>', function(result) {
            console.log('result: ', result);
            if (result) {
                window.location.href = that.href;
            }
        });
        return false;
    })
});
