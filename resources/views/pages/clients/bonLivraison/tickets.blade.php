<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Colis Sticker</title>
                    <link href="../../../public/storage/assets/home-page/css/bootstrap.min.css" />
                    <style>
                        .sticker {
                            width: 650px;
                            height: 450px;
                            background-color: #fff;
                            border: 1px solid #000;
                            border-radius: 5px;
                            padding: 10px;
                            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
                            font-family: sans-serif;
                            font-size: 14px; 
                        }
                        
                        .sticker .info {
                            display: flex;
                            flex-wrap: wrap;
                        }
                        .sticker .info span {
                            margin-right: 10px;
                        }
                        .sticker .commentaire {
                            font-style: italic;
                        }
                        td {
                            border: #000 2px solid;
                        }
                        .sticker .barcode {
                            text-align: center;
                        }
                        .row {
                            display: flex;
                            flex-wrap: wrap;
                            margin-right: -15px;
                            margin-left: -15px;
                        }
                        .col-4 {
                            flex: 0 0 33.333333%;
                            max-width: 33.333333%;
                            padding-right: 15px;
                            padding-left: 15px;
                        }
                        .col-8 {
                            flex: 0 0 66.666667%;
                            max-width: 66.666667%;
                            padding-right: 15px;
                            padding-left: 15px;
                        }
                        .table {
                            display: table;
                            width: 100%;
                            max-width: 100%;
                            margin-bottom: 1rem;
                            background-color: transparent;
                        }
                    </style>
                </head>
                <body>';

        foreach ($colis as $c) {
            $html .= '
                    <div class="sticker " style="margin-top:50px;margin-bottom:360px">
                        <div class="row">
                            <div class="col-8">
                                <div class="info">
                                    <span>Date:</span> 2024-05-04
                                </div>
                                <div class="info">
                                    <span>Vendeur:</span> Carol Thompson ( +1 (919) 584-7463 )
                                </div>
                                <table class="table">
                                    <tr>
                                        <td><strong>Destinataire:</strong></td>
                                        <td>' . $c->destinataire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Téléphone:</strong></td>
                                        <td>' . $c->telephone . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Adresse:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commentaire:</strong></td>
                                        <td>' . $c->commentaire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Produit:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                </table>
                                <h4 class="fw-bold">ERRAZY LIVRASON</h4>
                                <table class="table">
                                    <tr>
                                        <td colspan="4"><strong>Ramasse</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>PR</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>IJ</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RB</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>AN</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RF</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4" >
                               
                            </div>
                        </div>
                        <table class="table " style="width: 400px; height: 10px;">
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>Value</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Interdit d\'ouvrir</strong></td>
                                <td><div class="badge">Colis normal</div></td>
                            </tr>
                        </table>
                        <div class="barcode"></div>
                    </div>';
        
                </body>
                </html>