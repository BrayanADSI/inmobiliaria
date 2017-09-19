<html>
  <head>
    <title>
      SISTEMA INMOBILIARIO JN
    </title>
    <meta charSet="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/devices.css">
	 
  </head>
  <body>
    <header class="header">
      <div class="container-lrg">
        <div class="col-12 spread">
          <div>
            <a class="logo">
              <img src="logo.jpg" width="280" height="100"/>
            </a>
            </div>
          <div>
            <a class="nav-link" href="#">
              Twitter
            </a>
            <a class="nav-link" href="#">
              Facebook
            </a>
          </div>
        </div>
      </div>
      <div class="container-lrg flex">
        <div class="col-6 centervertical">
          <h1 class="heading">
            Sistema De Informacion Inmobiliaria JN
          </h1>
          <h2 class="paragraph ">
            La Inmobiliaria JN es tu mejor opcion para &nbsp;tu negocio con una &nbsp;gran variedad de precios accesibles. La inmobiliaria JN cuenta con sistema de informacion de alta calidad el cual le permite a los directivos agilisar procesos llevando un registro de todos sus clientes y todas sus actividades en la inmobiliaria JN
          </h2>
          <div class="ctas">
			  <form action="controlador/controladorLogin.php" method="post">
		   <h7 class="heading"> Ingrese al sistema</h7>
           <input class="ctas-input"  name="femailusuario" type="text" maxlength="60" placeholder="example@emial.com" required autofocus> 
           <input class="ctas-input"  name="fclaveusuario" type="password" placeholder="Password" required>
           <button class="ctas-button" name="fEnviar" type="submit" value="Ingresar">Ingresar</button>
			</form>

							  <?php
				@$mensaje= $_GET ['mensaje'];
				if (isset($mensaje)) {
					if ($mensaje=='incorrecto'){
						echo '<div class="alert alert-danger" role="alert"> Usuario o clave incorrecto </div>';
					   }
				}
				?>
          </div>
        </div>
        <div class="col-6 sidedevices">
          <div class="computeriphone">
            <div class="computer">
              <div class="mask">
                <img class="mask-img" src="img/webapp.svg">
              </div>
            </div>
            <div class="iphone">
              <div class="mask">
                <img class="mask-img" src="img/mobileapp.svg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="feature5">
      <div class="container-sml text-center">
        <div class="col-12">
          <h3 class="heading">
            COMODIDAD Y MANEJO EFICIENTE&nbsp;
          </h3>
        </div>
      </div>
      <div class="container-lrg flex">
        <div class="col-5 centervertical">
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              Registro de nuevos clientes
            </h3>
            <p class="paragraph">
              Launchaco instantly shows you the most relevant domain names. Followed by hundreds of new gtlds. Get your .gold domain name today!
            </p>
          </div>
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              facil manejo economico&nbsp;
            </h3>
            <p class="paragraph">
              Con el sistema de informacion JN se quiere brindar &nbsp;rapides y eficacia al momento de ingresar nuevos cliente en su base de datos eliminando el &nbsp;incomodo manejo de papeles en los sistemas de informacion convencionales&nbsp;
            </p>
          </div>
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              Organizacion eficiente&nbsp;
            </h3>
            <p class="paragraph">
              Con este sistema el usuario tiene la opcion de llevar un registro de deudas, abonos o pagos de cada cliente para asi evitar confusiones a la hora de hacer &nbsp;cuentas y tener un &nbsp;chequeo economico mas organizado de toda la inmobiliaria&nbsp;
            </p>
          </div>
        </div>
        <div class="col-1">
        </div>
        <div class="col-6">
          <div class="sidedevices">
            <div class="computerwrapper">
              <div class="computer">
                <div class="mask">
                  <img class="mask-img" src="img/webapp.svg">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="socialproof">
      <div class="container-sml">
        <div class="flex text-center">
          <div class="col-12">
            <h4 class="subheading">
              "Nos ha permitido guardar nuestros registros e informacion de &nbsp;manera mas facil, organizada y segura" Francisco Staton(Director de la empresa Arcos Dorado)
            </h4>
            <p class="paragraph">
              Sean Howell - CEO @ Hornetapp
            </p>
          </div>
        </div>
      </div>
      <div class="container-lrg">
        <div class="logos flex">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
          <img class="col-3" src="img/launchacologo.svg">
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container-sml flex text-center">
        <div class="col-12">
          <h3 class="heading">
            Somos Calidad Para Tu Negocio
          </h3>
          <div class="ctas">
            <a class="ctas-button" href="">
              <img src="img/applelogo.svg">
              <span>
                App Store
              </span>
            </a>
            <a class="ctas-button" href="">
              <img src="img/androidlogo.svg">
              <span>
                Play Store
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="container-lrg footer-nav flex">
        <div class="col-3 vertical">
          <a class="logo">
            Launchaco
          </a>
          <a class="nav-link2">
            ©2016 Compute.Studio
          </a>
        </div>
        <div class="col-3 vertical">
          <a class="nav-link2">
            About
          </a>
          <a class="nav-link2">
            Features
          </a>
          <a class="nav-link2">
            Pricing
          </a>
        </div>
        <div class="col-3 vertical">
          <a class="nav-link2">
            Twitter
          </a>
          <a class="nav-link2">
            Facebook
          </a>
          <a class="nav-link2">
            Contact
          </a>
        </div>
        <div class="col-3 vertical">
          <a class="nav-link2">
            123 Address lane #708, 90210, California, United States of America
          </a>
        </div>
      </div>
    </div>
  </body>
</html>