document.addEventListener("DOMContentLoaded", function(){

    document.forms[0].onsubmit = function(e){
       return val(e);
    }
 
    password.oninput = function(e){
       val(e);
    }
 
    function val(e){
 
       var qtde = 0,
           v = password.value,
           cor = "#fff",
           e = e.type == "submit";
    
       if(v.match(/.{6,}/))
            qtde++;

       if(v.match(/[A-Z]{1,}/))
            qtde++;
 
       if(v.match(/[0-9]{1,}/))
            qtde++;
 
       var validacao = 'Fraca';
       switch (qtde)
       {
            case 2:
                validacao = 'M\u00e9dia'; break;
            case 3:
                validacao = 'Forte'; break;
       }

       document.getElementById('medidor').innerHTML = "<strong>For\u00e7a:&nbsp;</strong>" + validacao;
    }
 });