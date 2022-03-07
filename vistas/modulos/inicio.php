<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Inicio
      
      <small>Bienvenido</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Bienvenido</li>
    
    </ol>

  </section>

 <section class="content">
  


         

            <div class="box box-primary ">

             <div class="box-header">

               <div class="message-box" style="background-image: url('vistas/img/plantilla/logo-blanco-bloque.png');background-repeat: no-repeat;background-position: bottom right; ">

              <?php


             echo '<h1 >Bienvenid@ <br> ' .$_SESSION["nombre"].' ' .$_SESSION["apellido"].'<br>' .$_SESSION["fechaActual"].' </h1>';
                ?>

                </div>


             </div>

             </div>
              <div class="box box-primary">


            <div class="box-body">

              <a href="usuarios">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box bg-purple">
                    <span class="info-box-icon"><i class="fa fa-user-circle-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">modificar </span>
                      <span class="info-box-number">Usuario</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description"> 

                      </span>
                    </div>
                  </div>
                </div>
              </a>

              <a href="productos">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box bg-purple">
                    <span class="info-box-icon"><i class="fa fa-product-hunt"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Administrar</span>
                      <span class="info-box-number">Productos</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description"> 

                      </span>
                    </div>
                  </div>
                </div>
              </a>


              <a href="crear-venta">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box bg-purple">
                    <span class="info-box-icon"><i class="fa fa-handshake-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Crear</span>
                      <span class="info-box-number">Venta</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description"> 

                      </span>
                    </div>
                  </div>
                </div>
              </a>


              <a href="ventas">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box bg-purple">
                    <span class="info-box-icon"><i class="fa fa-product-hunt"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Administrar</span>
                      <span class="info-box-number">Ventas</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description"> 

                      </span>
                    </div>
                  </div>
                </div>
              </a>




            </div>
          </div>

        

    
            

  </section>
 
</div>
