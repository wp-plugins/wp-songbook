jQuery(document).ready(function($){
var custom_uploader;
$('#songbook_addfile_button').click(function(e) {
    e.preventDefault();
    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
        custom_uploader.open();
        return;
    }
    //Extend the wp.media object
    custom_uploader = wp.media.frames.file_frame = wp.media({
        title:songbook_filebox_script.choosefiles,
        button: {
            text:songbook_filebox_script.selectfiles_butt
        },
        multiple: true
    });
    custom_uploader.on('select', function() {
            var selection = custom_uploader.state().get('selection');
            selection.map( function( attachment ) {
            attachment = attachment.toJSON();
            $("#obal").prepend('<div class="file" id="file_'+attachment.id+'"><span class="exticon '+extension(attachment.url)+'"></span><div class="maininfo"><p class="filetitle"><a id="href_'+attachment.id+'" href="'+attachment.url+'">'+attachment.filename+'</a><br/></p><input type="hidden" id="fileid" name="fileid[]" value="'+attachment.id+'"/><input type="hidden" id="private_'+attachment.id+'" name="private_'+attachment.id+'" value="private"/><input type="hidden" id="url_'+attachment.id+'" name="url_'+attachment.id+'" value="'+attachment.url+'"/><input type="hidden" id="level_'+attachment.id+'" name="level_'+attachment.id+'" value="1"/><input type="hidden" id="fileext_'+attachment.id+'" name="fileext_'+attachment.id+'" value="'+extension(attachment.url)+'"/><input type="hidden" id="title_'+attachment.id+'" name="title_'+attachment.id+'" value="'+attachment.filename+'"/><p class="toolbar"><span class="toolspan"><a class="textch" rel="'+attachment.id+'"></a><a class="lock locked" rel="'+attachment.id+'"></a><a class="remover" rel="'+attachment.id+'"></a></span></p></div></div>');
            });
            if($("#nofile").text()!==0)$("#nofile").remove();
        });
    custom_uploader.open();
});
});