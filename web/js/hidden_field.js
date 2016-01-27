$(document).ready(function(){
                    // verificamos que al principio se muestra o no se muestra
        if($('#proyectoalcance-requiere_accion_no_financiera').val()!='1'){
                         $('#1especifique_con_cual').css('display','none');
                        $('#1requiere_nombre_institucion').css('display','none');
                        $('#1requiere_nombre_instancia').css('display','none');
                        $('#1requiere_mencione_acciones').css('display','none');
        }
        if($('#proyectoalcance-contribuye_complementa').val()!='1'){
                        $('#2especifique_complementa_cual').css('display','none');
                        $('#2contribuye_nombre_institucion').css('display','none');
                        $('#2contribuye_nombre_instancia').css('display','none');
                        $('#2contribuye_mencione_acciones').css('display','none');

        }

        if($('#proyectoalcance-vinculado_otro').val()!='1'){


                        $("#3vinculado_especifique").css('display','none');
                         $("#3vinculado_nombre_institucion").css('display','none');
                         $("#3vinculado_nombre_instancia").css('display','none');
                         $("#3vinculado_nombre_proyecto").css('display','none');
                         $("#3vinculado_medida").css('display','none');

        }

       $("select[name='ProyectoAlcance[requiere_accion_no_financiera]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $('#1especifique_con_cual').css('display','none');
                        $('#1requiere_nombre_institucion').css('display','none');
                        $('#1requiere_nombre_instancia').css('display','none');
                        $('#1requiere_mencione_acciones').css('display','none');
                        //borramos datos

                         $('#proyectoalcance-especifique_con_cual').val(null); 
                        $('#proyectoalcance-requiere_nombre_institucion').val('');
                        $('#proyectoalcance-requiere_nombre_instancia').val('');
                        $('#proyectoalcance-requiere_mencione_acciones').val('');
                        
    }
    if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil
                        $('#1especifique_con_cual').css('display','block');
                        $('#1requiere_nombre_institucion').css('display','block');
                        $('#1requiere_nombre_instancia').css('display','block');
                        $('#1requiere_mencione_acciones').css('display','block');
                    }
    });

       $("select[name='ProyectoAlcance[contribuye_complementa]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $('#2especifique_complementa_cual').css('display','none');
                        $('#2contribuye_nombre_institucion').css('display','none');
                        $('#2contribuye_nombre_instancia').css('display','none');
                        $('#2contribuye_mencione_acciones').css('display','none');

                        //borramos los datos
                        $('#proyectoalcance-especifique_complementa_cual').val(null); 
                        $('#proyectoalcance-contribuye_nombre_institucion').val('');
                        $('#proyectoalcance-contribuye_nombre_instancia').val('');
                        $('#proyectoalcance-contribuye_mencione_acciones').val('');
            //$('#Serial_Monitor').hide();  
        }
        if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil
                        $('#2especifique_complementa_cual').css('display','block');
                        $('#2contribuye_nombre_institucion').css('display','block');
                        $('#2contribuye_nombre_instancia').css('display','block');
                        $('#2contribuye_mencione_acciones').css('display','block');
                    }
    });

       $("select[name='ProyectoAlcance[vinculado_otro]']").change(function(){
        if ($(this).val()== '0') { // Muestra el campo de portatil y oculta los campos de escritorio.
            
                        $("#3vinculado_especifique").css('display','none');
                         $("#3vinculado_nombre_institucion").css('display','none');
                         $("#3vinculado_nombre_instancia").css('display','none');
                         $("#3vinculado_nombre_proyecto").css('display','none');
                         $("#3vinculado_medida").css('display','none');

                        //borramos los datos
                        $('#proyectoalcance-vinculado_especifique').val(null); 
                        $('#proyectoalcance-vinculado_nombre_institucion').val('');
                        $('#proyectoalcance-vinculado_nombre_instancia').val('');
                        $('#proyectoalcance-vinculado_nombre_proyecto').val('');
                        $('#proyectoalcance-vinculado_medida').val('');

        }
        if  ($(this).val()== '1') { // Muestra los campos de escritorio y oculta el de portatil

                         $("#3vinculado_especifique").css('display','block');
                         $("3vinculado_nombre_institucion").css('display','block');
                         $("#3vinculado_nombre_instancia").css('display','block');
                         $("#3vinculado_nombre_proyecto").css('display','block');
                         $("#3vinculado_medida").css('display','block');
            
                        
                        
        }
    });








});