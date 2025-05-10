<?php

class TermsOfServiceView{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function display() {

        $html = '<head>
        	<title>UNIverse Book Exchange</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
			<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="../Styles/star-styles.css">	
        <style>
        body {
          font-family: Arial, Helvetica, sans-serif;
          margin: 0;
        }

        html {
          box-sizing: border-box;
        }

        *, *:before, *:after {
          box-sizing: inherit;
        }

        .column {
          float: left;
          width: 33.3%;
          margin-bottom: 16px;
          padding: 0 8px;
        }

        .card {
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
          margin: 8px;
          border: 2px solid violet;
          border-radius: 5px;
          background-color: rgba(200,200,200,0.2);
          color: violet;
        }


        .container {
          padding: 0 16px;
        }

        .container::after, .row::after {
          content: "";
          clear: both;
          display: table;
        }

        .title {
          color: grey;
        }

        .small-text{
          color: #e5bee4;
        }

        .button {
            background-color: rgba(100,100,100,0.5);
            color: violet;
            padding: 10px;
            font-size: 16px;
            border: 2px solid violet;
            cursor: pointer;
            border-radius: 5px;
            width: 40%;
        }

        .button:hover {
            background-color: #0158a3;
        }

        @media screen and (max-width: 650px) {
          .column {
            width: 100%;
            display: block;
          }
        }
        </style>
        </head>
        <body>';


        $html .= '
        <div class="jumbotron" style="padding: 0px;margin-left: 25%;margin-right: 25%;background-color: rgba(200,200,200,0.3);border: 2px solid violet;color: violet;border-radius: 5px;">
            <div class="container">
            <h1 style="text-align: center;"> Terms of Service </h1> 
                <h2>Your listings and content<h2/> 
            <small class="small-text"> 
                    I.	You grant us certain permissions to use your listings and content. We may display product or service listings shared by you or on your behalf (each a “Product Listing”) on the UNIverse Book Exchange. You grant us a non-exclusive, perpetual, irrevocable, transferable, sub-licensable, royalty-free, worldwide license to host, use, distribute, modify, run, copy, publicly perform, make available, display, translate, and create derivative works of the Product Listings and any other content, data, or information shared by you or on your behalf or accessed by us in connection with the Commerce Features, including photos and videos (together with Product Listings, your “Seller Content”), in connection with the UNIverse Book Exchange. You represent and warrant that you have all necessary rights in Seller Content to grant us the licenses and rights set forth in these Seller Terms. <br></br>
                    II.	You are responsible for your listings and content. Even if we host and display your Seller Content on UNIverse Book Exchange Products, you are solely responsible for the contents of your Seller Content. You must ensure that all Seller Content is true, accurate and complete at all times, including without limitation the description, price, applicable taxes or fees, shipping information, required legal disclosures and other advertisement, offer or promotional content. You are solely responsible for setting the price of products or services you offer. If we provide guidance regarding a suggested price for products or services you offer, such guidance is informational only and the decision to accept or reject such guidance is solely yours.<br></br>
                    III.	You must ensure that your Product Listing provides Users with the terms, conditions and policies that apply to the transaction for that product. You are responsible for displaying, keeping up to date and honoring any sales, returns and/or privacy policies and all other relevant terms or information or disclosures related to your Product Listings that you want to apply to your interactions with Users or that are otherwise required by law. Any such terms, information, or disclosures do not bind us and must not conflict with these Seller Terms or our other applicable terms and policies.<br></br>
                    <br></br>
            </small>
                <h2>Your products and services<h2/>
            <small class="small-text"> 
                    I.	You must comply with our terms and all applicable laws when you use Commerce Features. Your products and services, Seller Content and use of Commerce Features must comply at all times with these Seller Terms, our other applicable terms and policies and applicable laws, rules, and regulations. You agree that you are solely responsible for determining that the Commerce Features are suitable for your intended use.<br></br>
                    II.	Sales of counterfeit or pirated products as well as anything not describable as a book. Without limiting the generality of the policies set forth above, you are expressly prohibited from displaying, promoting, offering, marketing or selling counterfeit or pirated products as well as anything not describable as a book. <br></br>
                    III.	You are responsible for providing customer service to Users in connection with your products and services. You are responsible for providing, managing, paying for, and fulfilling any sales, warranty and customer service, returns, refunds or accommodations to Users in connection with your use of a Commerce Feature.<br></br>
                    IV.	You are responsible for ensuring the integrity and safety of your products and services. As between us, you are solely responsible for any defect or non-conformity in any product or service you offer and for complying with any recall or safety alert, or similar direction or notice, with respect to any product or service related to your Product Listings. You agree to promptly remove any Product Listing upon issuance of any recall or safety alert, or similar direction or notice, or claim of infringement of intellectual property rights with respect to products or services relating to your Product Listings.<br></br>
                    V.	We may review your Seller Content to ensure the integrity of our services, but this does not change your obligations to us or to Users. These reviews may include automated or other audits of your Seller Content to verify compliance with these Seller Terms and applicable law, but do not mean that we assume any responsibility or liability or otherwise agree to modify your responsibilities and liabilities under these Seller Terms and applicable law.<br></br>
                    <br></br>
            </small>
                <h2>Our services<h2/>
            <small class="small-text"> 
                    I.	We may modify or cease providing our services. We may modify or cease operating any Commerce Feature, with or without prior notice or liability to you.<br></br>
                    II.	We may make ratings and reviews available about you and your listings. We may display ratings and reviews related to you or your Product Listings. We have no responsibility for the content of such ratings and reviews. Except for those ratings and reviews which are part of your Seller Content, you do not own or have any rights in or to such content. You understand we may use automated software to present more useful ratings and reviews to Users. Any ratings or reviews you submit shall comply with our policies and applicable law. Without limiting the foregoing, you may not submit or cause or allow others to submit illegitimate or inauthentic ratings or reviews.<br></br>
                    III.	Our role. While we may provide certain services to enable transactions or to help resolve issues with buyers, we have no control over and do not guarantee the performance or actions of any buyer, including the ability of buyers to pay for products or services you offer or that a buyer will actually complete a transaction.<br></br>
                    <br></br>
            </small>
                <h2>Your use of UNIverse Book Exchange Users data<h2/>
            <small class="small-text"> 
                    I.	You may only use User data in accordance with these Seller Terms. You may only use any Users data, content, or other information you receive from UNIverse Book Exchange in connection with your use of the Commerce Features (“User Data”) in accordance with our applicable terms and policies. You may not sell or misuse User Data. Without limiting the generality of the foregoing, you may use User Data to support the transactions arising from the Users use of the Commerce Features or for any purpose for which you have obtained the valid consent of the User or otherwise have a legal basis.<br></br>
                    II.	You will cooperate with us to help ensure User privacy. You will promptly notify us in writing when you become aware of a security incident or receive notice of any regulatory or enforcement inquiry regarding privacy or data security in connection with your use of Commerce Features or User Data, including any involving your Service Providers, unless you are otherwise instructed by a law enforcement or regulatory agency. You will cooperate with us in investigating and remediating a security incident and in responding to a regulatory inquiry or enforcement.<br></br>
                    <br></br>
            </small>
                <h2>Enforcement of our terms<h2/>
            <small class="small-text"> 
                    I.	We reserve the right to review your use of Commerce Features and take any actions we deem necessary or advisable in our discretion to protect us or our Users, which may include remedies up to and including suspension or termination of any or all our services to you.<br></br>
                    II.	Our failure to enforce any part of our terms or policies is not a waiver of our right to do so at a later date.<br></br>
                    III.	In connection with our review of your use of Commerce Features, we may request information from you. You agree to promptly comply with our requests.<br></br>
                    <br></br>
            </small>
                <h2>Indemnification<h2/>
            <small class="small-text"> 
                    I.	You agree to indemnify and hold us harmless from and against any claims (including but not limited to claims for property damage, bodily injury or death, and to the extent permitted by law, claims based on our negligence), damages, losses and expenses of any kind (including reasonable legal fees and costs) (collectively, “Claims”) arising from or related to your sale of products using our Commerce Features, the products you sell using our Commerce Features, your acts or omissions with respect to User Data or any breach or alleged breach of these Seller Terms.<br></br>
                    <br></br>
            </small>
                <h2>Other terms and conditions<h2/>
            <small class="small-text"> 
                    I.	These Seller Terms do not create any partnership, joint venture, franchise, sales representative or agency relationship between you and UNIverse Book Exchange or an exclusive relationship between us.<br></br>
                    II.	We may change or update these Seller Terms at any time in our sole discretion. If we make changes or updates, we will provide you with notice such as by email or by posting the amended Seller Terms. All amended Seller Terms will become effective immediately on the date posted unless we state otherwise, and will apply prospectively after such changes and updates become effective. Your continued use of the Commerce Features constitutes acceptance of those changes and updates.<br></br>
                    III. If any portion of these Seller Terms are found to be unenforceable, then (except as otherwise provided) that portion will be severed and the remaining portion will remain in full force and effect.<br></br>
                    <br></br>
            </small>

            <form method="POST">

            <input type="hidden" value="iAgree" name="action">
                    <p style="text-align: center;"><button class="button" submit-button" >I Agree</button></p>
                </form>

            </div>
        </div>

        <div class="space stars1"></div>
        <div class="space stars2"></div>
        <div class="space stars3"></div>

            </div>
          </div>
        </div>

        </body>';

        return $html;
    }
}
