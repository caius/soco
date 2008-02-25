// function to select the content of the div (objId is the id of the div) 

function fnSelect(objId) { 
   fnDeSelect(); 
   if (document.selection) { 
      var range = document.body.createTextRange(); 
      range.moveToElementText(document.getElementById(objId)); 
      range.select(); 
   } 
   else if (window.getSelection) { 
      var range = document.createRange(); 
      range.selectNode(document.getElementById(objId)); 
      window.getSelection().addRange(range); 
   } 
} 
       
// function to deselect the selected contents 

function fnDeSelect() { 
   if (document.selection) 
             document.selection.empty(); 
   else if (window.getSelection) 
              window.getSelection().removeAllRanges(); 
}