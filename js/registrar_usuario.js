    function comprobarOption(){

        
      var opcion = document.getElementById("cbtipo").selectedIndex;
      if(opcion==0){
        document.captura.txtdocumento.disabled=false;
        document.captura.txtnombre.disabled=false;
        document.captura.txtapellido.disabled=false;
        document.captura.txtcorreo.disabled=false;
        document.captura.txtcodigo.disabled = false;
        document.captura.txtcontrasena.disabled = false;
        document.captura.txtconfirmar.disabled = false;
        document.captura.cbplan.disabled=false;
        document.captura.cbasignatura.disabled = true;
        document.captura.cbgrupo.disabled = true;
      }
      if(opcion == 1){
        document.captura.txtdocumento.disabled=false;
        document.captura.txtnombre.disabled=false;
        document.captura.txtapellido.disabled=false;
        document.captura.txtcorreo.disabled=false;
        document.captura.txtcodigo.disabled = true;
        document.captura.txtcontrasena.disabled = false;
        document.captura.txtconfirmar.disabled = false;
        document.captura.cbplan.disabled=true;
        document.captura.cbasignatura.disabled = false;
        document.captura.cbgrupo.disabled = false;
      }
    }