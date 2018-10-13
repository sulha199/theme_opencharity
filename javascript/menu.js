// move down nav menu if there is admin toolbar
function responsive_menu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "") {
        x.className += " responsive";
    } else {
        x.className = "";
    }
}

function pullFooterToBottom(){
    if (document.getElementById('wrapper').offsetHeight + document.getElementsByTagName('footer')[0].offsetHeight <= window.innerHeight){
        document.getElementById('wrapper').style.minHeight = '100%'; 
        document.getElementById('wrapper').style.marginBottom = document.getElementsByTagName('footer')[0].offsetHeight * -1 +'px';
    }
    else{
        document.getElementById('wrapper').style.minHeight = null;
        document.getElementById('wrapper').style.marginBottom = 0;
    }
}

(function () {
    window.addEventListener("resize", pullFooterToBottom);
    document.addEventListener("DOMContentLoaded", function () {
        var admin_toolbar = document.getElementById('toolbar');
        if (typeof(admin_toolbar) != 'undefined' && admin_toolbar != null)
        {
            document.getElementById('myTopnav').style.top = admin_toolbar.offsetHeight + 'px';
        }
        pullFooterToBottom();
    });
}());