/* 
 * author: Shulha Yahya
 */

(function () {
    // fix remove issue in IE
    if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        };
    }

    function Ocslider(className) {
        this.className = className;
        this.sliders = document.getElementsByClassName(className);
        this.widthGap = 0.01;
        this.init();
    }

    Ocslider.prototype = {
        init: function () {
            console.log('slider initiates')
            for (var i = 0; i < this.sliders.length; i++) {
                var el = this.sliders[i];
                var pw = el.offsetWidth;
                var width;
                var sidebutton = false;

                // retrieving classes
                el.className.split(' ').map(function (v, i) {
                    if (v.indexOf("flex-width-") == 0) {
                        width = parseInt(v.substring(11));
                    }

                    if (v == 'flex-sidebutton') {
                        sidebutton = true;
                    }
                });
                // assign width to col
                var childs = el.getElementsByClassName('views-row');
                var colcount = Math.floor(pw / width);
                var buttons = Math.ceil(pw / width);
                var coldiv = (childs.length < colcount) ? childs.length : colcount;
                var colwidth = (100 / coldiv) - this.widthGap;


                if (childs.length < 2) {
                    return;
                }
                for (var j = 0; j < childs.length; j++) {
                    childs[j].style.width = colwidth + '%';
                    childs[j].offsetWidth = colwidth + '%';
                    childs[j].name = j;
                }


                var buttonCount = Math.ceil(childs.length / colcount);
                // make sure the active button is not for button outside 
                var currentActiveButtonIdByCurrentOffset = Math.round((parseFloat(childs[0].style.left) || 0) / -100);
                var currentActiveButtonId = Math.min(currentActiveButtonIdByCurrentOffset, buttonCount - 1);
                // make sure the left ofset not outside the bound
                this.pullBy(el, currentActiveButtonId * 100, colcount);

                if (sidebutton) {
                    this.putSideButton(el, colcount, i);
                } else {
                    this.putBulletButton(el, colcount, i);
                }
            }
        },
        putSideButton: function (el, colcount, i) {
            var childs = el.getElementsByClassName('views-row');
            var butl = el.getElementsByClassName('side-button-l');
            if (butl.length > 0) {
                butl[0].remove();
            }
            var butr = el.getElementsByClassName('side-button-r');
            if (butr.length > 0) {
                butr[0].remove();
            }

            // reduce .view-content width by 50px
            el.getElementsByClassName('view-content')[0].style.width = (el.getElementsByClassName('view-content')[0].style.offsetWidth - 50) + 'px';

            // left buttons
            butl = document.createElement("a");
            butl.className = 'side-button-l';
            butl.innerHTML = "&#10094;";
            butl.onclick = function (e) {
                OSlider.pullLeft(OSlider.sliders[i], colcount);
            };
            // right buttons
            butr = document.createElement("a");
            butr.className = 'side-button-r';
            butr.innerHTML = "&#10095;";
            butr.onclick = function (e) {
                OSlider.pullRight(OSlider.sliders[i], colcount);
            };

            if (Math.ceil(childs.length / colcount) > 1) {
                el.insertBefore(butr, el.getElementsByClassName('view-content')[0]);
                el.insertBefore(butl, el.getElementsByClassName('view-content')[0]);
                el.classList.add('has-button');
                // check the button whether should be outside 
                if (el.getElementsByClassName('view-content')[0].offsetWidth + 2 * el.getElementsByClassName('view-content')[0].offsetLeft + 60 < window.innerWidth) {
                    el.classList.add('has-button-outside');
                } else {
                    el.classList.remove('has-button-outside');
                }
            } else {
                el.classList.remove('has-button');
                el.classList.remove('has-button-outside');
            }

        },
        putBulletButton: function (el, colcount, i) {
            //remove buttons
            var buts = el.getElementsByClassName('slide-buttons');

            var childs = el.getElementsByClassName('views-row');
            // always remove buttons
            if (buts.length > 0) {
                buts[0].remove();
            }
            // initiate new button
            // add butttons
            buts = document.createElement("div");
            buts.className = 'slide-buttons';
            el.appendChild(buts);

            var buttonCount = Math.ceil(childs.length / colcount);
            // make sure the active button is not for button outside 
            var currentActiveButtonIdByCurrentOffset = Math.round((parseFloat(childs[0].style.left) || 0) / -100);
            var currentActiveButtonId = Math.min(currentActiveButtonIdByCurrentOffset, buttonCount - 1);
            for (var j = 0; j < buttonCount; j++) {
                var node = document.createElement("a");
                node.className = "flex-slider-button";
                node.innerHTML = "&#9679;"
                if (j == currentActiveButtonId)
                    node.className += " active";
                buts.appendChild(node);
            }

            // if the button only 1 then hide it and no need to attach click even
            if (buttonCount <= 1) {
                buts.getElementsByClassName('flex-slider-button')[0].style.visibility = 'hidden';
                return;
            }

            // append event to bullet buttons
            var bulletButtons = el.getElementsByClassName('flex-slider-button');
            for (j = 0; j < bulletButtons.length; j++) {
                bulletButtons[j].onclick = function (e) {
                    node = e.target;
                    var activ = this.parentNode.getElementsByClassName('active');
                    if (activ.length > 0) {
                        activ[0].classList.remove("active");
                    }
                    this.classList.add("active");
                    OSlider.pullBy(OSlider.sliders[i], Array.prototype.indexOf.call(node.parentNode.childNodes, node) * 100, colcount);
                };
            }
        },
        pullBy: function (sliderObj, offset, colcount) {
            var childs = sliderObj.getElementsByClassName('view-content')[0].getElementsByClassName('views-row');
            for (var j = 0; j < childs.length; j++) {
                childs[j].style.left = Math.floor(offset * -1 - (j * 1.0 / (colcount + 0))) + '%';
            }
        },
        pullLeft: function (sliderObj, colcount) {
            var childs = sliderObj.getElementsByClassName('view-content')[0].getElementsByClassName('views-row');
            var offset = (parseFloat(childs[0].style.left) || 0) - 100;
            var maxPull = Math.ceil(childs.length / colcount);
            if (offset <= maxPull * -100)
                offset = 0;
            for (var j = 0; j < childs.length; j++) {
                childs[j].style.left = Math.floor(offset - j * 1.0 / (colcount + 0)) + '%';
            }
        },
        pullRight: function (sliderObj, colcount) {
            var childs = sliderObj.getElementsByClassName('view-content')[0].getElementsByClassName('views-row');
            var offset = (parseFloat(childs[0].style.left) || 0) + 100;
            var maxPull = Math.ceil(childs.length / colcount);
            if (offset > 0)
                offset = (maxPull - 1) * -100;
            for (var j = 0; j < childs.length; j++) {
                childs[j].style.left = Math.floor(offset - j * 1.0 / (colcount + 0)) + '%';
            }
        }
    }

    var OSlider;
    document.addEventListener("DOMContentLoaded", function () {
        OSlider = new Ocslider('flex-slider');
    });

    window.addEventListener("resize", function () {
        OSlider.init();
    });


    document.getElementsByClassName('side-button-l').onclick = function () {
        OcSlider.transformLeft(this.parentNode);
    }

}());