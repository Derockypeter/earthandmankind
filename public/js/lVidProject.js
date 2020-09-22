M.AutoInit();
// function print(body){
//     let printContents = document.getElementById(body).innerHTML;
//     let originalContents = document.body.innerHTML
//     document.body.innerHTML = printContents;

//     window.print();

//     document.body.innerHTML = originalContents;
// }
function synopsis (inputString){
    var div = document.createElement('div')
    div.innerHTML = inputString
    return div.textContent.slice(0, 200)
}