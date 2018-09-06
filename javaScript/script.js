navListhover(); // behaviour for the header links
function navListhover() {
    $(".nav-link").mouseenter(function () {
        $(this).addClass('hover');
    }).mouseleave(function () {
        $(this).removeClass('hover');
    });
}

createxmlHttpRequest();
// create XMLHttprequest instance
function createxmlHttpRequest() {
    var xmlHttp ; // reference for XMLHttprequest obect
    // try catch for the exceptions in creating xmlHttp object
    try{
        xmlHttp = new XMLHttpRequest(); // create the object rightaway
    }catch (e){
        try {
            xmlHttp = new ActiveXObject("Microsoft.XMLHttp"); // for I.E 6  or older browsers
            console.log("ActiveXObject created successifully");
        }catch (e){ }
    }
    if(!xmlHttp)
        console.log("Error creating the XMLHttpRequest object");
    else
        console.log("XMLHttpRequest object created successifully");
        return xmlHttp;
}
