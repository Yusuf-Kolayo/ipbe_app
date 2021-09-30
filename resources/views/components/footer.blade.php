
   <div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; 2020 Double Assure Prudential.
            </div>
            <div class="nk-footer-links">
                <ul class="nav nav-sm">
                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>






<!-- jQuery           -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip         -->



<script src="{{ asset('assets/js/bundle.js?ver=2.2.0') }}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=2.2.0') }}"></script>
<script src="{{ asset('assets/js/charts/gd-default.js?ver=2.2.0') }}"></script> 


<script>

    function setCookie(name,value,days) {
        var expires = "";
        if (days) { 
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    $("#theme_switch").click(function() {

    if ($("body").hasClass("dark-mode")) {
            setCookie("theme","light",30);  console.log('light theme set');
            $("body").removeClass("light-mode");

            $("#theme_switch").addClass("active");

            $("#top_nav").removeClass("is-dark");
            $("#side_nav").removeClass("is-dark");

            $("#top_nav").addClass("is-light");
            $("#side_nav").addClass("is-light");
    }      
    else  {     
        setCookie("theme","---",30);  console.log('dark theme set'); 
        $("body").removeClass("dark-mode");  
        $("#theme_switch").removeClass("active");

        $("#top_nav").removeClass("is-light");
        $("#side_nav").removeClass("is-light");

        $("#top_nav").addClass("is-dark");
        $("#side_nav").addClass("is-dark");
    }
    
    });

$(document).ready(function() { 
var theme = getCookie("theme");
if (theme == 'light') {
    $("body").removeClass("dark-mode");
    $("#theme_switch").removeClass("active");

    $("#top_nav").removeClass("is-dark");
    $("#side_nav").removeClass("is-dark");

    $("#top_nav").addClass("is-light");
    $("#side_nav").addClass("is-light");
}
else {
    $("body").removeClass("light-mode");
    $("#theme_switch").addClass("active");

    $("#top_nav").removeClass("is-light");
    $("#side_nav").removeClass("is-light");

    $("#top_nav").addClass("is-dark");
    $("#side_nav").addClass("is-dark");
}
});    



$(document).ready(function() {  
    function scroll_to_top (e) { document.querySelector('.nk-block-head-content').scrollIntoView({  behavior: 'smooth' }); }

if ($('#cus_table').length > 0) { 
  var element = document.getElementById('cus_table'); 
  element.addEventListener('DOMSubtreeModified', scroll_to_top);
}
});


</script>

