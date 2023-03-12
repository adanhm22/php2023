let article;
window.onload = init;

function init(){
    article = document.getElementById("articulo");
}


function cambio(valor)
{
    fetch(valor + ".html").then((res) => res.text()).then((res)=>{
        res = res.split('<article class="articulo">').pop().split('</article>')[0];
        document.querySelector(".articulo").innerHTML = res;
        
    });    
}

function guardar ()
{
    
}

