var tipObj = null;
//offset along x and y in px
var offset = {
    x: 20,
    y: 20
};

/********************************************************************
 * injectTooltip(e,data)
 * inject the custom tooltip into the DOM
 ********************************************************************/
function injectTooltip(event, data) {
    if (!tipObj && event) {
        coordPropName = null;
        eventPropNames = Object.keys(event);
        if(!coordPropName){
            //discover the name of the prop with MouseEvent
          for(var i in eventPropNames){
            var name = eventPropNames[i];
            if(event[name] instanceof MouseEvent){
                coordPropName = name;
              console.log("--> mouse event in", coordPropName)
              break;
            }
          }
        }
        // console.log(coordPropName);
        //create the tooltip object
        tipObj = document.createElement("div");
        //tipObj.style.width = '100px';
       // tipObj.style.height = '40px';

        tipObj.style.background = "#FFFFFF";
        tipObj.style.color = "#333";
        tipObj.style.borderRadius = "2px";
        tipObj.style.padding = "5px";
        tipObj.style.fontFamily = "Arial,Helvetica";
        tipObj.style.textAlign = "center";
        tipObj.style.fontStyle = "italic";
        tipObj.style.zIndex = "99999";
        tipObj.innerHTML = data;

        //position it
        tipObj.style.position = "fixed";
        tipObj.style.top = event[coordPropName].clientY + window.scrollY + offset.y + "px";
        tipObj.style.left = event[coordPropName].clientX + window.scrollX + offset.x + "px";

        //add it to the body
        document.body.appendChild(tipObj);
    }
}

/********************************************************************
 * moveTooltip(e)
 * update the position of the tooltip based on the event data
 ********************************************************************/
function moveTooltip(event) {
    if (tipObj && event) {
        //position it

        coordPropName = null;
        eventPropNames = Object.keys(event);
        if(!coordPropName){
            //discover the name of the prop with MouseEvent
          for(var i in eventPropNames){
            var name = eventPropNames[i];
            if(event[name] instanceof MouseEvent){
                coordPropName = name;
              // console.log("--> mouse event in", coordPropName)
              break;
            }
          }
        }
        tipObj.style.top = event[coordPropName].clientY + window.scrollY + offset.y + "px";
        tipObj.style.left = event[coordPropName].clientX + window.scrollX + offset.x + "px";
    }
}

/********************************************************************
 * deleteTooltip(e)
 * delete the tooltip if it exists in the DOM
 ********************************************************************/
function deleteTooltip(event) {
    if (tipObj) {
        //delete the tooltip if it exists in the DOM


            try {
            document.body.removeChild(tipObj);
            tipObj = null;
            }
            catch(err) {
            // document.getElementById("demo").innerHTML = err.message;
            }


    }
}
