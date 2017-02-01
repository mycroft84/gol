/**
* jquery.fileManager
* by Tibor Karcsics
* email: mycroft84gmail.com
* 
*/
    
;(function($){
	
	//get classList
	function getClassList(target)
   	{
		return target.attr('class').split(/\s+/);
   	}
    
    function build(container,o)
    {
        var theme = "";
        switch(o.theme)
        {
            case 'tinymce': 
                theme = 'tinymce';
                
            default: theme = "redactor";
        }
        
        var dialog = "";
        dialog+="<div id='jquery-filemanager-dialog' class='"+theme+"'>";
            dialog+="<div class='jquery-filemanager-dialog-header'>"
                dialog+="<button id='jquery-filemanager-create'>Create</button>";
                dialog+="<button id='jquery-filemanager-upload'>Upload</button>";
                
                dialog+="<button id='jquery-filemanager-refresh'>Refresh</button>";
                dialog+="<button id='jquery-filemanager-upload'>List</button>";
                dialog+="<button id='jquery-filemanager-upload'>Grid</button>";
                dialog+="<input name='jquery-filemanager-searchinput'>";
                dialog+="<button id='jquery-filemanager-searchbutton'>Search</button>";
            dialog+="</div>";
            dialog+="<div class='jquery-filemanager-dialog-body'>"
                dialog+="<div class='jquery-filemanager-dialog-body'>"    
            dialog+="</div>";
        dialog+="</div>";
        
        if (!$("#jquery-filemanager-dialog").length)
                container.append(dialog);
                
    }
    
    var methods = {
	    init : function( options ) {
		
    		var defaults =   {
                theme: 'redactor'
       	    };
       	   
       	   var opts = $.extend(defaults, options);
       	   
       	   return $(this).each(function(){
                var $this = $(this);
                var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
                $(this).data('o',o);
                
                build($(this),o);
                
                $("#jquery-filemanager-dialog").dialog({
                    modal: true,
                    resizable: false,
                    width: 800,
                    height: 600,
                    title: "Filemanager",
                    autoOpen: false, 
                });
           });
            
         }  
               
    };
	
	$.fn.fileManager = function(method)
	{
	     // Method calling logic
	    if ( methods[method] ) {
	      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
	      return methods.init.apply( this, arguments );
	    } else {
	      $.error( 'Method ' +  method + ' does not exist on jQuery.fileManager' );
	    }
	}
		
})(jQuery)