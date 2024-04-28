<!DOCTYPE html>
<html dir="ws_config_dir" lang="ws_config_lang">
     <head>
	 		<style>
			 :root {
				--main-color: #813266;
				--second-color: #b12a6c;
				--third-color: #c82c6c;
				--fourth-color: #813266;
				--fifth-color: #813266;
				--hover-color: #b12a6c;
				--focus-color: #7c2570;
			}
			</style>
            <title>Accueil - vitex </title>
            <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="description" content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne. Donnez à votre entreprise en ligne un avantage concurrentiel grâce aux solutions de livraison sur mesure de commerce électronique de livraison." />
    <meta name="keywords" content="" />
            <link rel="icon" href="https://cdn.vitex.ma/images/company/1702590775-780-1651191227-530-icone siteweb.jpeg" sizes="16x16" type="image/png"> 
            <link rel="icon" href="https://cdn.vitex.ma/images/company/1702590775-780-1651191227-530-icone siteweb.jpeg" sizes="16x16 32x32" type="image/png"> 
			<base href="http://vitex.ma/" >


            <meta name="author" content="Digixel.ma" />
            
        <!-- keywords -->
        <meta name="keywords" content="livraison à domicile maroc,livraison à domicile,livraison Maroc,livraison Agadir,For livraison,ForLivraison, livraison, amana livraison, Oubratra , Livraison,coursier,coursier maroc casa,coursier rapide,service coursier,livraison,tournee programee,courises expresse,delivery maroc,Service Livraison et Ramassage">
        <!-- favicon -->
		<meta name="title" content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne" />
		<meta property="og:title" content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne" />
		<meta property="og:description" content="livraison œuvre avec rapidité et agilité et assure une distribution transparente de bout en bout avec passion et engagement." />
		<meta property="og:image" content="https://cdn.vitex.ma/images/logo.png" /> 
		<meta property="og:url" content="https://cdn.vitex.ma/" /> 
		<meta property="og:type" content="page" />
<!-- Bootstrap CSS --> 

        <link rel="stylesheet"  href="{{asset('storage/assets/home-page/css/bootstrap.min.css')}}">
		<!-- Owl Theme Default CSS --> 
		
        <link rel="stylesheet"  href="{{asset('storage/assets/home-page/css/owl.theme.default.min.css')}}">
        <!-- Owl Carousel CSS --> 
        <link rel="stylesheet"  href="{{asset('storage/assets/home-page/css/owl.carousel.min.css')}}">
        <!-- Owl Magnific CSS --> 
        <link rel="stylesheet"  href="{{asset('storage/assets/home-page/css/magnific-popup.css')}}">
        <!-- Animate CSS --> 
        <link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/animate.css">
        <!-- Boxicons CSS --> 
		<link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/boxicons.min.css">
        <!-- Flaticon CSS --> 
		<link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/flaticon.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/meanmenu.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/nice-select.css">
		<!-- Odometer CSS-->
		<link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/odometer.css">
        <!-- Style CSS -->
        <link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/style.css">
        <!-- Responsive CSS -->
		<link rel="stylesheet"  href="https://cdn.vitex.ma/assets/home-page/css/responsive.css">
		<link href="https://cdn.vitex.ma/styles/styles-ws.css?v=4.00" rel="stylesheet" />
		<!-- Favicon -->
		<link rel="stylesheet" href="https://cdn.vitex.ma/assets/main-page/css/aos.css">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="https://cdn.vitex.ma/assets/main-page/css/style.css">
		<link rel="stylesheet" href="https://cdn.vitex.ma/assets/home-page/css/floatingapp.css">

		
		


<style>


</style>
</head>


 

  <body>
  <div id="bg-res"></div>
  <div id="result-ajax"></div>
  <div id="result"></div>

  <div id="page-iframe-box">
  <div id="page-iframe-in">
	<div id="page-iframe-header">
	  <div id="page-iframe-header-btns">
		<a href="javascript:closeIframeBox();" ><i class="fa fa-times"></i></a>
	  </div>
	</div>
	<div id="page-iframe-content"></div>
  </div>
</div> 
<div class="modal fade" id="ajaxResultModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myCenterModalLabel"><!----></h4>
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">×</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>

	<!-- Start Preloader Area -->
		<div class="preloader">
			<div class="lds-ripple">
				<div></div>
				<div></div>
			</div>
		</div>
		<!-- End Preloader Area -->
		
		<!-- Start Preloader Area -->
		<div id="loading" class="preloader">
			<div class="lds-ripple">
				<div></div>
				<div></div>
			</div>
		</div>
		<!-- End Preloader Area -->

		@include('components.includes.header')



		<!-- Start Sidebar Modal -->
		<div class="sidebar-modal">  
			<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									<i class="bx bx-x"></i>
								</span>
							</button>
							<h2 class="modal-title" id="myModalLabel2">
								<a class="side-bar-header" href="https://cdn.vitex.ma/">
									<img src="https://cdn.vitex.ma/images/front/logo-side-bar.png" class="logo-header" alt="Logo">
									
								</a>
							</h2>
						</div>
						<div class="modal-body">
							<div class="sidebar-modal-widget">
								<h3 class="title">À propos de nous</h3>
								<p>Livraison œuvre avec rapidité et agilité et assure une distribution transparente de bout en bout avec passion et engagement.</p>
							</div>
							<div class="sidebar-modal-widget">
								<h3 class="title">Liens supplémentaires</h3>
								<ul>
									<li>
										<a href="http://vitex.ma/clients/">Espace client</a>
									</li>
									<li>
										<a href="http://vitex.ma/clients//register">Devenir client</a>
									</li>
								
								</ul>
							</div>
							<div class="sidebar-modal-widget">
								<h3 class="title">Contact Info</h3>
								<ul class="contact-info">
									<li>
										<i class="bx bx-location-plus"></i>
										ADRESSE
										<span>Marrakech</span>
									</li>
									<li>
										<i class="bx bx-envelope"></i>
										Email
										<span>contact@livraison.ma</span>
									</li>
									<li>
										<i class="bx bxs-phone-call"></i>
										TÉLÉPHONE
																	
										<span>0600000000</span>
									</li>
								</ul>
							</div>
							<div class="sidebar-modal-widget">
								<h3 class="title">Connecte-toi avec nous</h3>
								<ul class="social-list">
								
						   <li>
							<a href="">
								<i class="bx bxl-facebook"></i>
							</a>
						</li>
						<li>
							<a href="">
								<i class="bx bxl-instagram"></i>
							</a>
						</li>
					
						<li>
							<a href="">
								<i class="bx bxl-youtube"></i>
							</a>
						</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Sidebar Modal -->

		<!-- Start Search Box Modal -->
		<div class="search-wrap">
			<div class="search">
				<button type="button" class="close">×</button>
				<form>
					<input type="search" value="" class="form-control" placeholder="Type Here..." />
					<button type="submit" class="default-btn">
						Search
					</button>
				</form>
			</div>
		</div>
		<!-- End Search Box Modal -->

                          
                               
 
 
 <!-- Start Search Box Modal -->
		<div class="search-wrap">
			<div class="search">
				<button type="button" class="close">×</button>
				<form>
					<input type="search" value="" class="form-control" placeholder="Type Here..." />
					<button type="submit" class="default-btn">
						Search
					</button>
				</form>
			</div>
		</div>
		<!-- End Search Box Modal -->

		<!-- Start Prevoz Slider Area -->
		<section class="prevoz-slider-area prevoz-slider-area-five">
			<div class="prevoz-slider-style owl-carousel owl-theme">
				<div class="prevoz-slider-item " style="background-image: url(https://cdn.vitex.ma//images/front/slider.jpg);">
					<div class="d-table">
						<div class="d-table-cell">
							<div class="container">
								<div class="prevoz-slider-text one ">
									<a class="white video-btn video-btn-animat popup-youtube"  href="https://www.youtube.com/watch?v=Q7tYF5Bf2ok">
										<i class="bx bx-play"></i>
									</a>
									<h1 class="slider-text-header"></h1>
			                         <p class="slider-text-paragraph"></p>
									<div class="slider-btn">
									<a href="http://vitex.ma/clients//register"  class="default-btn active">Devenir client</a>
									<a href="http://vitex.ma/clients/"  class="default-btn active">Espace client</a>


									
									</div>
								</div>
								<div class="lines">
									<div class="line"></div>
									<div class="line"></div>
									<div class="line"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			
			</div>
			<div class="shape">
				<div class="shape-img">
					<img src="https://cdn.vitex.ma/images/front/slider-shape.png" alt="Image">
				</div>
			</div>
		</section>
		<!-- End Prevoz Slider Area -->

		<!-- Start Counter Area -->
		<section class="counter-area counter-area-five pb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-counter">
							<i class="flaticon-box"></i>
							<h2>
								<span class="odometer" data-count="50000+">00</span> <span class="traget"></span>
							</h2>
							<p>Colis livrés</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-counter">
							<i class="flaticon-planet-earth"></i>
							<h2>
								<span class="odometer" data-count="350+">00</span> <span class="traget"></span>
							</h2>
							<p>Villes couvertes</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-counter">
							<i class="flaticon-support"></i>
							
							<h2>
								<span class="odometer" data-count="2000">00</span> <span class="traget"></span>
							</h2>
							<p>Clients satisfaits</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-counter">
							<i class="flaticon-product-realise"></i>
							<h2>
								<span class="odometer" data-count="10000">00</span> <span class="traget"></span>
							</h2>
							<p>Kg de marchandise</p>
						</div>
					</div>
				</div>
			</div>
			<div class="lines">
				<div class="line-two"></div>
				<div class="line-two"></div>
				<div class="line-two"></div>
			</div>
		</section>
		<!-- End Counter Area -->


		<!-- Start What We Offer Area -->
	
		<section class="what-offer-area-two mt-minus-70 pb-70" id="services-section" style=" background: linear-gradient( to top, rgba(255,255,255, 0.95), rgba(255,255,255, 0.95) ) , url(https://cdn.vitex.ma//images/front/bg-transparent.png) center repeat;">
		
			
			
			<div class="tracking-number-area tracking-number-area-five pb-70 pt-70">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5">
							<div class="tracking-content">
								<h2>Veuillez utiliser ce formulaire pour suivre votre commande manuellement</h2>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="tracking-body">
								<form action="action?action=tracking" id="tracking-form"  method="post" class="tracking-wrap">
												<input type="text" class="input-tracking"  name="parcel-code" placeholder="Tapez votre numéro de suivi" name="Tracking">
												<button class="default-btn active" type="submit" value="submit">Suivre maintenant</button>
											</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-offer">
						<i class="icon flaticon-warehouse"></i>
						<h3>Ramassage</h3>
						<p>Le ramassage est un service mis en place par la société vitex afin de faciliter au maximum votre processus d’expédition.</p>
					
					</div>
				</div>
			<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-offer">
						<i class="icon flaticon-fast-delivery"></i>
						<h3>Livraison</h3>
						<p>Grâce à une connaissance du terrain, nos livreurs récupèrent les colis pour une livraison en mains propres à vos clients dans plusieurs villes.</p>
					
					</div>
				</div>
			
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-offer">
						<i class="icon flaticon-stopwatch"></i>
						<h3>Expédition</h3>
						<p>L’équipe de vitex assure l’acheminement de vos colis à votre destinataire contre un accusé de réception.</p>
						</br>
					
					</div>
				</div>
				
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-offer" >
						<i class="icon flaticon-payment-method"></i>
						<h3>Fonds et paiements</h3>
						<p>Nous assure le retour de fonds dans 48 H, des Virements, des bons de livraison d’une manière régulière sur les services de messagerie de nos clients.</p>
					
					</div>
				</div>
			</div>
				<div id="about-section"></div>
			</div>
	
		</section>
		<!-- End What We Offer Area -->

		
		<!-- Start About Area -->


		<section class="about-area about-area-two about-area-four pb-100" >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="about-content">
							<span>CONNAÎTRE NOUS </span>
							<h2>vitex</h2>
							<p>Vitex  est la nouvelle solution d'expédition pour gérer vos livraisons en ligne. Donnez à votre entreprise en ligne un avantage concurrentiel grâce aux solutions de livraison sur mesure de commerce électronique de Vitex.  La société Vitex assure l’expédition, l’arrivage, le ramassage, la livraison, le retour des fonds,la confirmation, le stock , la gestion documentaire et propose à chaque client professionnel ou particulier une offre de prestation complète, variée et optimale grâce à une expérience riche et professionnelle sur le marché de la messagerie nationale..</p>
								
							<a class="white video-btn popup-youtube"  href="https://www.youtube.com/watch?v=Q7tYF5Bf2ok">
								<i class="bx bx-play"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-6 pr-0">
						<div class="about-img" style="background-image: url(https://cdn.vitex.ma//images/front/about-img-two.jpg);">
							<div class="about-list">
								<h3>Nos priorités principales:</h3>
								<ul>
									<li>
										<i class="flaticon-checked"></i>
										Les solutions clients et employés prennent du temps.
									</li>
									<li>
										<i class="flaticon-checked"></i>Nous accomplissons nos objectifs plus efficacement.			
									</li>
									<li>
										<i class="flaticon-checked"></i>La collaboration de communication transparente le fait correctement.									
									</li>
									<li>
										<i class="flaticon-checked"></i>Il fournit une feuille de route pour une productivité accrue.
									</li>
									<li>
										<i class="flaticon-checked"></i>Fournir des conseils indépendants pour vous.									
									</li>
									<li>
										<i class="flaticon-checked"></i>Système de support disponible 24/7									
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
			<div class="lines">
				<div class="line-two"></div>
				<div class="line-two"></div>
				<div class="line-two"></div>
			</div>
			</div>
		</section>
		<!-- End About Area -->

		<!-- start Service Area -->
		<section class="service-area service-area-two service-area-five fun-blue-bg pt-100 pb-100"  id="avantages-section">
			<div class="container">
					<div class="section-title">
					<h2>Les avantages de choisir vitex</h2>
				</div>
				<div class="row">
					<div class="col-lg-4 col-sm-6">
						<div class="single-service">
							<div class="service-content-wrap">
								<i class="icon flaticon-home"></i>
								<h3>Gestion multicanal</h3>
								<p>Gérez des commandes à partir de tous les canaux sur lesquels vous vendez, y compris woocommerce et Shopify.</p>
							</div>
							<div class="service-heading">
								<h3>Gestion multicanal</h3>
							
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6">
						<div class="single-service">
							<div class="service-content-wrap">
								<i class="icon flaticon-package"></i>
								<h3>Insertion</h3>
								<p>Qu'ils soient transactionnels ou postaux, les systèmes d'insertion hautes performances de vitex offrent un traitement des documents sécurisé, efficace et flexible.</p>
							</div>
							<div class="service-heading">
								<h3>Insertion</h3>
							
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
						<div class="single-service">
							<div class="service-content-wrap">
								<i class="icon flaticon-server"></i>
								<h3>Plus de contrôle</h3>
								<p>Vous pouvez rechercher vos colis dont vous avez manqué la livraison ou vérifier l'état de l’avancement de vos colis qui doivent être livrés.</p>
							</div>
							<div class="service-heading">
							
								<h3>Plus de contrôle</h3>
									
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="lines">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</div>
		</section>
		<!-- End Service Area -->


	
<!-- End Began Area -->
		<section class="service-area service-area-two pt-100 pb-100">
			<div class="container">
				<div class="section-title">
					<span>A commencé avec des rôles</span>
					<h2>Veuillez respecter les règles pour rester en sécurité</h2>
				</div>
				<div class="began-top-wrap" style="background-image: url(https://cdn.vitex.ma//images/front/services.jpg);">
					<div class="row">
						<div class="col-lg-8">
							<div class="began-wrap">
								<h2>Protégez vos produits avec vitex</h2>
								<div class="row">
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-fast-delivery"></i>
											<h3>Livraison rapide et efficace</h3>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-lock"></i>
											<h3>Sécurité pour les outils de chargement</h3>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-stopwatch"></i>
											<h3>Suivi en temps réel</h3>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-payment-method"></i>
											<h3>Méthodes de paiement faciles</h3>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-warehouse"></i>
											<h3>Assistance 24/7 heures</h3>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 p-0">
										<div class="single-began">
											<i class="flaticon-distribution"></i>
											<h3>Stockage en entrepôt</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="lines">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</div>
		</section>
		<!-- End Began Area -->
		
		<section class="address-area pt-100 pb-70" style="background:  linear-gradient( to top, rgba(68,68,73, 0.95), rgba(68,68,73, 0.95) ) , url(https://cdn.vitex.ma//images/front/bg-transparent-4.png) center repeat;" id="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-address">
						<i class="bx bx-phone-call"></i>
						<h3>Contact</h3>
						<span>Parlez au support</span>
						<a href="tel:0600000000">0600000000</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-address">
						<i class="bx bx-location-plus"></i>
						<h3>Location</h3>
						<span>Trouvez où nous sommes</span>
						<p>Marrakech</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-address">
						<i class="bx bx-time"></i>
						<h3>Rencontre nous</h3>
						<span>Heures disponibles pour se réunir</span>
						<p>9:00 AM – 8:00 PM</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	


	
		


<div id="myButton"></div>

	@include('components.includes.footer')
		<!-- Start Go Top Area -->
		<div class="go-top">
			<i class='bx bx-chevrons-up bx-fade-up'></i>
			<i class='bx bx-chevrons-up bx-fade-up'></i>
		</div>
		<!-- End Go Top Area --> 

    </div>        
        <!-- Jquery Slim JS -->
        <script src="https://cdn.vitex.ma/assets/home-page/js/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdn.vitex.ma/assets/home-page/js/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.vitex.ma/assets/home-page/js/bootstrap.min.js"></script>
        <!-- Meanmenu JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/jquery.meanmenu.js"></script>
        <!-- Wow JS -->
        <script src="https://cdn.vitex.ma/assets/home-page/js/wow.min.js"></script>
        <!-- Owl Carousel JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/owl.carousel.js"></script>
        <!-- Owl Magnific JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/jquery.magnific-popup.min.js"></script>
        <!-- Nice Select JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/jquery.nice-select.min.js"></script>
		<!-- Appear JS --> 
        <script src="https://cdn.vitex.ma/assets/home-page/js/jquery.appear.js"></script>
		<!-- Odometer JS --> 
		<script src="https://cdn.vitex.ma/assets/home-page/js/odometer.min.js"></script>
		<!-- Parallax JS --> 
        <script src="https://cdn.vitex.ma/assets/home-page/js/parallax.min.js"></script>
		<!-- Form Ajaxchimp JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/jquery.ajaxchimp.min.js"></script>
		<!-- Form Validator JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/form-validator.min.js"></script>
		<!-- Contact JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/contact-form-script.js"></script>
		<!-- Map JS FILE -->
        <script src="https://cdn.vitex.ma/assets/home-page/js/map.js"></script>
        <!-- Custom JS -->
		<script src="https://cdn.vitex.ma/assets/home-page/js/custom.js"></script>

    <script type="text/javascript" src="https://cdn.vitex.ma/javascript/jquery-form.js"></script>

    <script src="https://cdn.vitex.ma/javascript/bootstrap-select.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/owl.carousel.min.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/jquery.sticky.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/jquery.waypoints.min.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/jquery.animateNumber.min.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/jquery.fancybox.min.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/jquery.easing.1.3.js"></script>
    <script src="https://cdn.vitex.ma/assets/main-page/js/aos.js"></script>
    <script type="text/javascript" src="https://cdn.vitex.ma/javascript/javascript-ws.js?v=4.00"></script>
	<script type="text/javascript" src="https://cdn.vitex.ma/assets/home-page/js/floatingapp.js"></script>
	<script>

	$("#myButton").floatingWhatsApp({
		phone: "+212600000000",
		popupMessage: "Bienvenue sur livraison, comment puis-je vous aider ?",
		message: "Salut livraison",
		showPopup: true,
		showOnIE: true,
		headerTitle: "Salut",
		headerColor: "green",
		backgroundColor: "crimson",
	
	});
	
	</script>
    <script src={{asset('storage/js/main.js')}}></script>

  

</body>  
</html>  
        
 