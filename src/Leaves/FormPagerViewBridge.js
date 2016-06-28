var formPager = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

formPager.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
formPager.prototype.constructor = formPager;

formPager.prototype.attachEvents = function () {
    var self = this;

    var aTags = this.viewNode.querySelectorAll(".pages a");
    for(var i = 0; i < aTags.length; i++){
        var aTag = aTags.length;

        aTag.addEventListener('click', function(event){

            self.viewNode.querySelector(".page-input").val(event.getAttibute('data-page'));
            var parent = self.viewNode.parentNode;
            while(parent){

                if (parent.tagName == "FORM"){
                    parent.submit();
                    break;
                }

                parent = parent.parentNode;
            }

            return false;
        });
    }
};

window.rhubarb.viewBridgeClasses.FormPagerViewBridge = formPager;