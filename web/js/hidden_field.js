$(document).ready(function(){

        if($('#proyectoalcance-requiere_accion_no_financiera').val()!='1'){
                        $('#1especifique_con_cual').hide();
                        $('#1requiere_nombre_institucion').hide();
                        $('#1requiere_nombre_instancia').hide();
                        $('#1requiere_mencione_acciones').hide();
        }
        if($('#proyectoalcance-contribuye_complementa').val()!='1'){
                        $('#2especifique_complementa_cual').hide();
                        $('#2contribuye_nombre_institucion').hide();
                        $('#2contribuye_nombre_instancia').hide();
                        $('#2contribuye_mencione_acciones').hide();

        }

        if($('#proyectoalcance-vinculado_otro').val()!='1'){


                        $('#3vinculado_especifique').hide();
                        $('#3vinculado_nombre_institucion').hide();
                        $('#3vinculado_nombre_instancia').hide();
                        $('#3vinculado_nombre_proyecto').hide();
                        $('#3vinculado_medida').hide();  


        }

       $("select[name='ProyectoAlcance[requiere_accion_no_financiera]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $('#1especifique_con_cual').hide();
                        $('#1requiere_nombre_institucion').hide();
                        $('#1requiere_nombre_instancia').hide();
                        $('#1requiere_mencione_acciones').hide();
                        //borramos datos

                         $('#proyectoalcance-especifique_con_cual').val(null); 
                        document.getElementById('proyectoalcance-requiere_nombre_institucion').value='';
                        document.getElementById('proyectoalcance-requiere_nombre_instancia').value='';
                        document.getElementById('proyectoalcance-requiere_mencione_acciones').value='';
                        var proyecto =document.getElementById('proyectoalcance-id_proyecto').value;
          /*              $.ajax({
                url: '?r=proyecto-alcance%2Fscenario_update&opcion='+proyecto,
                success: function(data) {
                                if(data.error) {
                                                alert(data.error);
                                        } else {
                                            alert('eee');

                                        }
                }
        })*/
    }
    if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil
            $('#1especifique_con_cual').show();
                        $('#1requiere_nombre_institucion').show();
                        $('#1requiere_nombre_instancia').show();
                        $('#1requiere_mencione_acciones').show();            
        }
    });

       $("select[name='ProyectoAlcance[contribuye_complementa]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $('#2especifique_complementa_cual').hide();
                        $('#2contribuye_nombre_institucion').hide();
                        $('#2contribuye_nombre_instancia').hide();
                        $('#2contribuye_mencione_acciones').hide();
                        //borramos los datos
                        $('#proyectoalcance-especifique_complementa_cual').val(null); 
                        document.getElementById('proyectoalcance-contribuye_nombre_institucion').value='';
                        document.getElementById('proyectoalcance-contribuye_nombre_instancia').value='';
                        document.getElementById('proyectoalcance-contribuye_mencione_acciones').value='';
            //$('#Serial_Monitor').hide();  
        }
        if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil
                        $('#2especifique_complementa_cual').show();
                        $('#2contribuye_nombre_institucion').show();
                        $('#2contribuye_nombre_instancia').show();
                        $('#2contribuye_mencione_acciones').show();            
        }
    });

       $("select[name='ProyectoAlcance[vinculado_otro]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $('#3vinculado_especifique').hide();
                        $('#3vinculado_nombre_institucion').hide();
                        $('#3vinculado_nombre_instancia').hide();
                        $('#3vinculado_nombre_proyecto').hide();
                        $('#3vinculado_medida').hide();  

                        //borramos los datos
                        $('#proyectoalcance-vinculado_especifique').val(null); 
                        document.getElementById('proyectoalcance-vinculado_nombre_institucion').value='';
                        document.getElementById('proyectoalcance-vinculado_nombre_instancia').value='';
                        document.getElementById('proyectoalcance-vinculado_nombre_proyecto').value='';
                        document.getElementById('proyectoalcance-vinculado_medida').value='';

        }
        if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil
                        $('#3vinculado_especifique').show();
                        $('#3vinculado_nombre_institucion').show();
                        $('#3vinculado_nombre_instancia').show();
                        $('#3vinculado_nombre_proyecto').show();
                        $('#3vinculado_medida').show();            
        }
    });








});