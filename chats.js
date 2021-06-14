$(document).ready(function(){
    $('.chats_class').click(function() {
    var clickId = $(this).attr('id');
    document.location.href="html/messages.html?id_chat=" + clickId;

  });
});