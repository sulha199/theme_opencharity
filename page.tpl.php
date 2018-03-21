<div id="wrapper">
    <nav id="myTopnav" class="">
        <div class="container">
            <a href="<?php print $front_page; ?>" id="sitelogo">
                <?php if ($logo): { ?>
                        <img src="<?php print $logo ?>" alt="<?php print $site_name . $site_slogan ?>" title="<?php print $site_name . $site_slogan ?>" id="logo" />
                    <?php }else : { ?>
                        <img src="/<?php print $directory; ?>/images/logo.png" alt="<?php print $site_name; ?>" height="80" width="150" />
                        <?php
                    }
                endif;
                ?>

            </a>      

            <?php if ($page['nav']): ?>    
                <?php print render($page['nav']); ?>
            <?php endif; ?> 
            <a href="javascript:void(0);" class="icon" onclick="responsive_menu()">&#9776;</a>
        </div>
    </nav>

    <header>
        <?php if ($page['header']): ?>    
            <?php print render($page['header']); ?>
        <?php endif; ?>  
    </header>

    <div id="main">
        <div id="content" <?php if ($page['sidebar_first']) echo 'style="margin-right:200px;"'; ?>>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?><h1><?php print $title; ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>

            <?php print render($messages); ?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

            <?php print render($page['content']); ?>
        </div>

        <?php if ($page['sidebar_first']): ?>    
            <div id="sidebar">
                <?php print render($page['sidebar_first']); ?>
            </div>
        <?php endif; ?>  
    </div>
    <footer>
        <div class="container">
            <?php if ($page['footer']): ?>    
                <?php print render($page['footer']); ?>
            <?php endif; ?>              
        </div>
    </footer>

</div>

<script>
    function responsive_menu() {
        var x = document.getElementById("myTopnav");
        if (x.className === "") {
            x.className += " responsive";
        } else {
            x.className = "";
        }
    }
</script>

<script>
    // fix remove issue in IE
    if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        };
    }

    function initFlexSlider() {
        var els = (document.getElementsByClassName('flex-slider'));

        for (var i = 0; i < els.length; i++) {
            var el = els[i];
            var pw = el.offsetWidth;
            var width;
            var sidebutton = false;

            // retrieving classes
            el.className.split(' ').map(function (v, i) {
                if (v.indexOf("flex-width-") == 0) {
                    width = parseInt(v.substring(11));
                }

                if (v == 'flex-sidebutton')
                    sidebutton = true;
            });
            var colcount = Math.floor(pw / width);
            var buttons = Math.ceil(pw / width);
            var colwidth = (100 / colcount) - 1;

            // assign width to col
            var childs = el.getElementsByClassName('views-row');
            if (childs.length < 2)
                continue;
            for (var j = 0; j < childs.length; j++) {
                childs[j].style.width = colwidth + '%';
                childs[j].offsetWidth = colwidth + '%';
                childs[j].name = j;
//                console.log(childs[j].style.width);
//                console.log(colwidth);
            }

            if (sidebutton) {
                var butl = el.getElementsByClassName('side-button-l');
                if (butl.length > 0) {
                    butl[0].remove();
                }
                var butr = el.getElementsByClassName('side-button-r');
                if (butr.length > 0) {
                    butr[0].remove();
                }

                // add buttons
                butl = document.createElement("a");
                butl.className = 'side-button-l';
                butl.innerHTML = "&#10094;";
//                butl.style.lineHeight  = childs[0].offsetHeight;
                butl.href = "javascript:transformLeft(document.getElementsByClassName('flex-slider')[" + i + "].getElementsByClassName('view-content')[0])";
                butr = document.createElement("a");
                butr.className = 'side-button-r';
                butr.innerHTML = "&#10095;";
                butr.href = "javascript:transformRight(document.getElementsByClassName('flex-slider')[" + i + "].getElementsByClassName('view-content')[0])";


//                el.parentNode.insertBefore(butr, el);
//                el.parentNode.insertBefore(butl, el);
                if (Math.ceil(childs.length / colcount) > 1) {
                    el.insertBefore(butr, el.getElementsByClassName('view-content')[0]);
                    el.insertBefore(butl, el.getElementsByClassName('view-content')[0]);
                }
//                var viewcontent = el.getElementsByClassName('view-content')[0];
//                viewcontent.insertBefore(butr, viewcontent.firstChild);
//                viewcontent.insertBefore(butl, viewcontent.firstChild);

                document.getElementsByClassName('side-button-l').onclick = function () {
                    transformLeft(this.parentNode);
                }

            } else {
                //remove buttons
                var buts = el.getElementsByClassName('slide-buttons');
                if (buts.length > 0) {
                    buts[0].remove();
                }
                {
                    // add butttons
                    buts = document.createElement("div");
                    buts.className = 'slide-buttons';
                    for (var j = 0; j < Math.ceil(childs.length / colcount); j++) {
                        var node = document.createElement("a");
                        node.className = "flex-slider-button";
                        node.innerHTML = "&#9679;"
                        if (j == 0)
                            node.className += " active";
//                        var textnode = document.createTextNode("*");
//                        node.appendChild(textnode);
                        node.href = "javascript:setTransform(document.getElementsByClassName('flex-slider')[" + i + "].getElementsByClassName('view-content')[0],'translate(" + -1 * (childs[colcount * j].offsetLeft - childs[0].offsetLeft) + "px)');"
                        buts.appendChild(node);
                    }
                    //buts.appendChild(document.createElement("a").appendChild(document.createTextNode("Water")));
                    if (Math.ceil(childs.length / colcount) > 1) {
                        el.appendChild(buts);
                    }
                }

                var ttt = el.getElementsByClassName('flex-slider-button');
                for (j = 0; j < ttt.length; j++) {
                    ttt[j].onclick = function () {
//                        console.log(this.parentNode);
                        var activ = this.parentNode.getElementsByClassName('active');
                        if (activ.length > 0)
                            activ[0].classList.remove("active");
                        ;
                        this.classList.add("active");
                        //this.pare
                    }
                }
            }

//            console.log(childs);
            el.getElementsByClassName('view-content')[0].style.transform = 'translate(0px)';
        }
//        var ttt = document.getElementsByClassName('flex-slider-button');
//        for (i = 0; i < ttt.length; i++) {
//            ttt[i].onclick = function () {
//                this.style.color = 'red';
//                //this.pare
//            }
//        }
    }

    function setTransform(obj, transform) {
        obj.style.transform = transform;
    }

    function transformLeft(obj) {
        var value = parseInt((obj.style.transform).match(/\((.*)\)/).pop());
        var childs = obj.getElementsByClassName('views-row');
        var width = parseInt(childs[0].offsetWidth);
        var pw = obj.parentNode.offsetWidth;
        var colcount = Math.floor(pw / width);
        var buttons = Math.ceil(pw / width);
        var colwidth = (pw / colcount);

        var translate = value - 1 * colcount * (childs[1].offsetLeft - childs[0].offsetLeft);
        console.log(translate);
        if (translate * -1 > childs.length * width)
            translate = 0;
        console.log(translate);
        obj.style.transform = "translate(" + translate + "px)";
    }
    function transformRight(obj) {
        var value = parseInt((obj.style.transform).match(/\((.*)\)/).pop());
        var childs = obj.getElementsByClassName('views-row');
        var width = parseInt(childs[0].offsetWidth);
        var pw = obj.parentNode.offsetWidth;
        var colcount = Math.floor(pw / width);
        var buttons = Math.ceil(pw / width);
        var colwidth = (pw / colcount);

        var translate = value + 1 * colcount * (childs[1].offsetLeft - childs[0].offsetLeft);
        console.log(translate);
        if (translate > 1)
            translate = -1 * (childs[childs.length - colcount].offsetLeft - childs[0].offsetLeft);
        console.log(translate);
        obj.style.transform = "translate(" + translate + "px)";
    }

    initFlexSlider();
    //window.addEventListener("resize", initFlexSlider);
    window.onresize = function () {
        initFlexSlider()
    };

    document.getElementsByClassName('flex-slider-button').onclick = function () {
        this.style.color = 'red';
    }
    document.getElementsByClassName('side-button-l').onclick = function () {
        alert('ad');
        transformLeft(this.parentNode);
    }
</script>