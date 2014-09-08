Dropzone.options.dropzoneForm = {
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    maxFilesize: 5
};
$('#clear_form').click(function()
{
    $('#add_main_form input').val('');
    $('#add_main_form textarea').val('');
});