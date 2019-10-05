<div class="content-wrapper">

    <section class="content-header">
      <h1>
        Gestor categorías
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor categorías</li>
      </ol>
    </section>


    <section class="content">


      <div class="box">

        <div class="box-header with-border">
          

          <div class="box-header with-border">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
              Agregar categoría
            </button>
          </div>
        </div>

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">
            <thead>
              <tr>
                <th>#</th>
                 <th>Categoría</th>
                  <th>Ruta</th>
                  <th>Estado</th>
                  <th>Descripción</th>
                  <th>Palabras Claves</th>
                  <th>Portada</th>
                  <th>Tipo de Oferta</th>
                  <th>Valor Oferta</th>
                  <th>Imagen Oferta</th>
                  <th>Fin Oferta</th>
                  <th>Acciones</th>
              </tr>
            </thead>
           
          </table>
          
        </div>
    
        
    
      </div>


    </section>

  </div>

  <!--=============================================
  =            MODAL AGREGAR CATEGORIA            =
  ==============================================-->
  
  <div id="modalAgregarCategoria" class="modal fade" role="dialog">
    
    <div class="modal-dialog">
      <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

         <!--=============================================
         =           CABEZA MODAL             =
         ==============================================-->

        <div class="modal-header" style="background: #3c8dbc; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

          
        </div>

         <!--=============================================
         =           CUERPO MODAL             =
         ==============================================-->

         <div class="modal-body">

           <div class="box-body">

               <!--=============================================
         =           input nombre categoria             =
         ==============================================-->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoría" name="tituloCategoria" required>
              </div>
            </div>


             <!--=============================================
         =           Entrada para la ruta de la categoria             =
         ==============================================-->

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                <input type="text" class="form-control input-lg rutaCategoria rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required>
              </div>
            </div>


               <!--=============================================
         =           Entrada para la descripcion de la categoria             =
         ==============================================-->

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea name="descripcionCategoria"   maxlength="120" class="form-control input-lg" required placeholder="Ingresar descripción de la categoría"></textarea>
              </div>
              </div>


           
                <!--=============================================
         =           Entrada palabras claves de la categoria             =
         ==============================================-->

         <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves separadas por comas" name="pClavesCategoria"  required>
              </div>
        </div>

           
         <!--=============================================
         =           Entrada para foto de portada            =
         ==============================================-->

         <div class="form-group">
             <div class="panel">SUBIR FOTO PORTADA</div>
             <input type="file" class="fotoPortada" name="fotoPortada">
             <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>
             <img src="" class="img-thumbnail previsualizarPortada" width="100%">
         </div>

         <!--=============================================
         =           Entrada para tipo de oferta            =
         ==============================================-->
          
          <div class="form-group">
            
            <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
              <option value="">No tiene oferta</option>
              <option value="oferta">Activar oferta</option>
            </select>

          </div>

          <div class="datosOferta" style="display:none">
            <!--==================================
            =            valor oferta            =
            ===================================-->
            
            <div class="form-group row">

              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                  <input type="number" name="precioOferta" min="0" step="any" placeholder="Precio" class="form-control input-lg valorOferta" id="precioOferta">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">
                  
                  <input type="number" name="descuentoOferta" min="0"  placeholder="Descuento" class="form-control input-lg valorOferta" id="descuentoOferta">
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                </div>
              </div>

            </div>
            
            <!--====  End of valor oferta  ====-->

            <!--======================================================
            =            ENTRADA PARA LA FECHA FIN OFERTA            =
            =======================================================-->
            
            <div class="form-group">
              <div class="input-group date">
                <input type="text" class="form-control datepicker input-lg valorOferta" name="finOferta">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            
            <!--====  End of ENTRADA PARA LA FECHA FIN OFERTA  ====-->
            
             <!--=============================================
         =           Entrada para foto de oferta           =
         ==============================================-->

         <div class="form-group">
             <div class="panel">SUBIR FOTO OFERTA</div>
             <input type="file" class="fotoOferta" name="fotoOferta">
             <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>
             <img src="" class="img-thumbnail previsualizarOferta" width="100px">
         </div>
            
          </div>   

        <!--====  End of  datos oferta   ====-->
               
        



           </div>

         </div>

          <!--=============================================
         =           PIE MODAL             =
         ==============================================-->


         <div class="modal-footer">
           
           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
           <button type="submit" class="btn btn-primary">Guardar categoría</button>

         </div>

       </form>

       <?php 
        

        $crearCategoria = new ControladorCategorias();
        $crearCategoria->ctrCrearCategoria();

        ?>

      </div>
    </div>

  </div>
  
  <!--====  End of MODAL AGREGAR CATEGORIA  ====-->


    <!--=============================================
  =            MODAL EDITAR CATEGORIA            =
  ==============================================-->
  
  <div id="modalEditarCategoria" class="modal fade" role="dialog">
    
    <div class="modal-dialog">
      <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

         <!--=============================================
         =           CABEZA MODAL             =
         ==============================================-->

        <div class="modal-header" style="background: #3c8dbc; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

          
        </div>

         <!--=============================================
         =           CUERPO MODAL             =
         ==============================================-->

         <div class="modal-body">

           <div class="box-body">

               <!--=============================================
         =           input nombre categoria             =
         ==============================================-->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoría" name="editarTituloCategoria" required>
                <input type="hidden" class="editarIdCategoria" name="editarIdCategoria">
                 <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">
              </div>
            </div>


             <!--=============================================
         =           Entrada para la ruta de la categoria             =
         ==============================================-->

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                <input type="text" class="form-control input-lg rutaCategoria rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required>
              </div>
            </div>


               <!--=============================================
         =           Entrada para la descripcion de la categoria             =
         ==============================================-->

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea name="descripcionCategoria"   maxlength="120" class="form-control input-lg descripcionCategoria" required placeholder="Ingresar descripción de la categoría"></textarea>
              </div>
              </div>


           
                <!--=============================================
         =           Entrada palabras claves de la categoria             =
         ==============================================-->
         
         <div class="form-group editarPalabrasClaves"></div>

         

           
         <!--=============================================
         =           Entrada para foto de portada            =
         ==============================================-->

         <div class="form-group">
             <div class="panel">SUBIR FOTO PORTADA</div>
             <input type="file" class="fotoPortada" name="fotoPortada">
             <input type="hidden" name="antiguaFotoPortada" class="antiguaFotoPortada">
             <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>
             <img src="" class="img-thumbnail previsualizarPortada" width="100%">
         </div>

         <!--=============================================
         =           Entrada para tipo de oferta            =
         ==============================================-->
          
          <div class="form-group">
            
            <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
              <option value="">No tiene oferta</option>
              <option value="oferta">Activar oferta</option>
            </select>

          </div>

          <div class="datosOferta" style="display:none">
            <!--==================================
            =            valor oferta            =
            ===================================-->
            
            <div class="form-group row">

              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                  <input type="number" name="precioOferta" min="0" step="any" placeholder="Precio" class="form-control input-lg valorOferta" id="precioOferta">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">
                  
                  <input type="number" name="descuentoOferta" min="0"  placeholder="Descuento" class="form-control input-lg valorOferta" id="descuentoOferta">
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                </div>
              </div>

            </div>
            
            <!--====  End of valor oferta  ====-->

            <!--======================================================
            =            ENTRADA PARA LA FECHA FIN OFERTA            =
            =======================================================-->
            
            <div class="form-group">
              <div class="input-group date">
                <input type="text" class="form-control datepicker input-lg finOferta" name="finOferta">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            
            <!--====  End of ENTRADA PARA LA FECHA FIN OFERTA  ====-->
            
             <!--=============================================
         =           Entrada para foto de oferta           =
         ==============================================-->

         <div class="form-group">
             <div class="panel">SUBIR FOTO OFERTA</div>
             <input type="file" class="fotoOferta" name="fotoOferta">
             <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>
             <img src="" class="img-thumbnail previsualizarOferta" width="100px">
         </div>
            
          </div>   

        <!--====  End of  datos oferta   ====-->
               
        



           </div>

         </div>

          <!--=============================================
         =           PIE MODAL             =
         ==============================================-->


         <div class="modal-footer">
           
           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
           <button type="submit" class="btn btn-primary">Guardar categoría</button>

         </div>

       </form>

       <?php 
        

        $editarCategoria = new ControladorCategorias();
        $editarCategoria->ctrEditarCategoria();

        ?>

      </div>
    </div>

  </div>

  <?php 

        $eliminarCategoria = new ControladorCategorias();
        $eliminarCategoria->ctrEliminarCategoria();

   ?>
  
  <!--====  End of MODAL EDITAR CATEGORIA  ====-->

  <!--===============================================
  =            BLOQUEO DE LA TECLA ENTER            =
  ================================================-->
  
  <script type="text/javascript">
     
     $(document).keydown(function(e){

    if(e.keyCode == 13){
    
     e.preventDefault();

    }

     })

  </script>
  
  
  <!--====  End of BLOQUEO DE LA TECLA ENTER  ====-->
  
  
