// JavaScript Document
 $(document).ready(
         function() {
         $("#sortme").sortable({
		 cursor: 'move',        // sets the cursor apperance
         opacity: 0.50,         // opacity fo the element while it's dragged
         update : function () {
         serial = $('#sortme').sortable('serialize');
         $.ajax({
         url: "sort_menu.php",
         type: "post",
         data: serial,
         error: function(){
         alert("theres an error with AJAX");
         }
         });
         }
         });
         }
         );	

