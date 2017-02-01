$(document).ready(function(){
   
   $("#newFile").change(function(){
        $("#addFilesForm").submit();        
   });
   
   $("#addFilesForm").submit(function(){
            
            $(this).ajaxSubmit({
                type: 'post',
                dataType: 'json',
                beforeSend: function() { $(".fileLoading").css('visibility','visible').hide().fadeIn('slow') },
                success: function(data) {
                    $(".fileLoading").fadeOut('slow',function(){
                        $(this).css({
                            display: 'block',
                            visibility: 'hidden'
                        }) 
                    });
                    
                    $("input[name='newFiles[]']").fileStyle("reset");
                    
                    $.each(data,function(index,value){
                        if ($(".file-item li").length)
                        {
                            $("#filesTemplate").tmpl(value).insertBefore(".file-item li:first").hide().fadeIn('slow');
                        }
                        else {
                            $("#filesTemplate").tmpl(value).appendTo(".file-item").hide().fadeIn('slow');   
                        }
                        $(".file-item").next('p').remove();   
                    })
                                
                }
            })
            
            return false;
    });
    
    $(".file-item").on('click','.del',function(){
         var parent = $(this).parents('li:first');
         var id = parent.attr('id');
         
         $(".delDialog").dialog({
            modal: true,
            resizable: false,
            buttons: [
                {
                    html: 'Törlés',
                    click: function() {
                        var dialog = $(this);
                        $.ajax({
                            url: ROOT+'files/ajax/del',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(data) {
                                if (!data.error)
                                {
                                    dialog.dialog('close');
                                    parent.fadeOut('slow',function(){
                                        $(this).remove();
                                        if ($(".file-item li").length == 0) $(".file-item").after("<p style='margin: 10px 0; clear: both'>Nincs feltöltött fájl</p>");
                                    });
                                }
                            }
                        })
                    }
                },
                {
                    html: 'Mégsem',
                    click: function() {
                        $(this).dialog('close');
                    }
                }
            ] 
       }); 
    });
    
});