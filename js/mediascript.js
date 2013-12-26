function removefile(elenme){
                   var remconfirm=window.confirm(songbook_filescr_translation.unlink_confirm);
                    if(remconfirm){
                        var d = document.getElementById("obal");
                        var d_nested = document.getElementById(elenme);
                        var throwawayNode = d.removeChild(d_nested);
                    }
               }
jQuery(document).ready(function($){
var custom_uploader;
$('#addfile_button').click(function(e) {
    e.preventDefault();
    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
        custom_uploader.open();
        return;
    }
    //Extend the wp.media object
    custom_uploader = wp.media.frames.file_frame = wp.media({
        title: songbook_filescr_translation.choosefiles,
        button: {
            text: songbook_filescr_translation.selectfiles_butt
        },
        multiple: true
    });
    custom_uploader.on('select', function() {
            var selection = custom_uploader.state().get('selection');
            selection.map( function( attachment ) {
            attachment = attachment.toJSON();
            $("#songbook_noncename").after('<p class="onefile" id="post_'+attachment.id+'"><input type="hidden" name="songbook_attachedfiles[]" value="'+attachment.id+'"><a class="removeele" onclick="removefile(\'post_'+attachment.id+'\');" alt="'+songbook_filescr_translation.removefile+'">X</a>&nbsp;&nbsp;<a href="'+attachment.url+'" target="_blank">'+attachment.filename+'</a></p>');
            });
    });
    custom_uploader.open();
});
});