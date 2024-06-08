@extends('layouts.app')
@section('content')
    <!-- Start Prevoz Slider Area -->
    @include('pages.landing.includes.slider-area')
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

    <section class="what-offer-area-two mt-minus-70 pb-70" id="services-section"
        style=" background: linear-gradient( to top, rgba(255,255,255, 0.95), rgba(255,255,255, 0.95) ) , url({{ asset('storage/images/bg-transparent.png') }}) center repeat;">



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
                            <form action="action?action=tracking" id="tracking-form" method="post" class="tracking-wrap">
                                <input type="text" class="input-tracking" name="parcel-code"
                                    placeholder="Tapez votre numéro de suivi" name="Tracking">
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
                        <p>Le ramassage est un service mis en place par la société ELM EXPRESS afin de faciliter au maximum votre
                            processus d’expédition.</p>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 p-0">
                    <div class="single-offer">
                        <i class="icon flaticon-fast-delivery"></i>
                        <h3>Livraison</h3>
                        <p>Grâce à une connaissance du terrain, nos livreurs récupèrent les colis pour une livraison en
                            mains propres à vos clients dans plusieurs villes.</p>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 p-0">
                    <div class="single-offer">
                        <i class="icon flaticon-stopwatch"></i>
                        <h3>Expédition</h3>
                        <p>L’équipe de ELM EXPRESS assure l’acheminement de vos colis à votre destinataire contre un accusé de
                            réception.</p>
                        </br>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 p-0">
                    <div class="single-offer">
                        <i class="icon flaticon-payment-method"></i>
                        <h3>Fonds et paiements</h3>
                        <p>Nous assure le retour de fonds dans 48 H, des Virements, des bons de livraison d’une manière
                            régulière sur les services de messagerie de nos clients.</p>

                    </div>
                </div>
            </div>
            <div id="about-section"></div>
        </div>

    </section>
    <!-- End What We Offer Area -->


    <!-- Start About Area -->


    <section class="about-area about-area-two about-area-four pb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content">
                        <span>CONNAÎTRE NOUS </span>
                        <h2>ELM EXPRESS</h2>
                        <p>ELM EXPRESS est la nouvelle solution d'expédition pour gérer vos livraisons en ligne. Donnez à votre
                            entreprise en ligne un avantage concurrentiel grâce aux solutions de livraison sur mesure de
                            commerce électronique de ELM EXPRESS. La société ELM EXPRESS assure l’expédition, l’arrivage, le ramassage,
                            la livraison, le retour des fonds,la confirmation, le stock , la gestion documentaire et propose
                            à chaque client professionnel ou particulier une offre de prestation complète, variée et
                            optimale grâce à une expérience riche et professionnelle sur le marché de la messagerie
                            nationale..</p>

                        <a class="white video-btn popup-youtube" href="https://www.youtube.com/watch?v=Q7tYF5Bf2ok">
                            <i class="bx bx-play"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 pr-0">
                    <div class="about-img" style="background-image: url({{ asset('storage/images/about-img-two.jpg') }});">
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
                                    <i class="flaticon-checked"></i>La collaboration de communication transparente le fait
                                    correctement.
                                </li>
                                <li>
                                    <i class="flaticon-checked"></i>Il fournit une feuille de route pour une productivité
                                    accrue.
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
    <section class="service-area service-area-two service-area-five fun-blue-bg pt-100 pb-100" id="avantages-section">
        <div class="container">
            <div class="section-title">
                <h2>Les avantages de choisir ELM EXPRESS</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-service">
                        <div class="service-content-wrap">
                            <i class="icon flaticon-home"></i>
                            <h3>Gestion multicanal</h3>
                            <p>Gérez des commandes à partir de tous les canaux sur lesquels vous vendez, y compris
                                woocommerce et Shopify.</p>
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
                            <p>Qu'ils soient transactionnels ou postaux, les systèmes d'insertion hautes performances de
                                ELM EXPRESS offrent un traitement des documents sécurisé, efficace et flexible.</p>
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
                            <p>Vous pouvez rechercher vos colis dont vous avez manqué la livraison ou vérifier l'état de
                                l’avancement de vos colis qui doivent être livrés.</p>
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
            <div class="began-top-wrap" style="background-image: url({{ asset('storage/images/services.jpg') }});">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="began-wrap">
                            <h2>Protégez vos produits avec ELM EXPRESS</h2>
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

    <section class="address-area pt-100 pb-70"
        style="background:  linear-gradient( to top, rgba(68,68,73, 0.95), rgba(68,68,73, 0.95) ) , url({{ asset('storage/images/bg-transparent-4.png') }}) center repeat;"
        id="contact-section">
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
@endsection
