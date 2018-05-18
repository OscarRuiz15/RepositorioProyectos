function cogerRes(frm,asignatura,year,periodo,grupo,documento){
    var titulo = frm.txtnombre.value;
    var descripcion = frm.txtdescripcion.value;
    var tr=document.getElementById("tabla2").getElementsByTagName("tr");
    var n=tr.length;
    var integrantes = new Array();
    if(titulo==""){
      alert("Complete el campo para el titulo del proyecto");
    }
    else if(descripcion==""){
      alert("Complete el campo para la descripcion del proyecto");
    }
    else if(n==1){
      alert("Aun no ha registrado integrantes al proyecto"); 
    }
    else{
        for(var i=1; i<tr.length; i++){
          //Como no más guardaremos el Documento o el Código del estudiante, cells es 0
          integrantes[i-1]=document.getElementById('tabla2').tBodies[0].rows[i].cells[0].innerHTML; 
        }

        integrantes[integrantes.length]=documento;
        var inte=integrantes.toString();

        window.location="/proyecto/php/Controlador/CrearProyecto.php?titulo="+titulo+"&descripcion="+descripcion+"&integrantes="+inte+"&asignatura="+asignatura+"&year="+year+"&periodo="+periodo+"&grupo="+grupo;
    }   

}
