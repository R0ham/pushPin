redirectIfLoggedOut();

$(document).ready(function() {
    $('#image-upload input').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#posterImg').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]);
          }
    });
});