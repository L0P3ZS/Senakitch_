 $(document).ready(function () {
     var $modal = $('.modal-frame');

    function closeModal() {
         $modal.hide();
     }

     $('.modal-popup').click(function () {
         $modal.show();
     });

     $('.modal-overlay, #close').click(function () {
         closeModal();
     });
     $(document).keyup(function (e) {
         if (e.which === 27) {
             closeModal();
         }
     });
 });
 $modal = $('.modal-frame');

 function enterNewConvo() {
   $('.create-chat-input').focus();
 }

 function closeModal() {
       	$modal.removeClass('active');
   $modal.addClass('leave');
 }

 $('.modal-popup').click(function() {
   $modal.toggleClass('active');
   $modal.removeClass('leave');
   enterNewConvo();
 })

 $('.modal-overlay').click(function() {
  closeModal();
 })

$('#close').click(function() {
   	closeModal();
 })

   $(document).keyup(function(e) {
     if(e.which === 27) {
       closeModal();
     }
   })