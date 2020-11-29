M.AutoInit();
function synopsis (inputString){
    var div = document.createElement('div')
    div.innerHTML = inputString
    return div.textContent.slice(0, 200)
}

function changeImg(){
    let img = document.querySelector('img');
    img.setAttribute("class", "responsive-img");
}
changeImg();