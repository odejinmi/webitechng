@php
    $faqContent = getContent('faq.content', true);
    $faqElements = getContent('faq.element', null, false, true);
@endphp
<!-- ============================ FAQ's Start ================================== -->







				<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ Section</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .faq-container {
    max-width: 600px;
    margin: 50px auto;
  }
  .faq-item {
    margin-bottom: 20px;
    position: relative;
  }
  .question {
    padding: 10px 20px;
    background-color: #30003D;
    color: white;
    border-radius: 50px;
    display: inline-block;
    position: relative;
    animation: slideIn 1s forwards;
  }
  .answer {
    padding: 10px 20px;
    background-color: rgba(255, 255, 255, 0);
    border: rgba(255, 255, 255, 0);
    border-radius: 5px;
    margin-top: 10px;
    display: none;
  }
  @keyframes slideIn {
    0% {
      opacity: 0;
      transform: translateX(-100%);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }
</style>
</head>
<body>

<div class="faq-container">
  <div class="faq-item">
    <div class="question">What cryptocurrencies can I trade on LtechNG?</div>
    <div class="answer">LtechNG supports the trading of various cryptocurrencies including Bitcoin (BTC), Bitcoin Cash (BCH), Binance Coin (BNB), Tether (USDT), Litecoin (LTC), Dogecoin (DOGE), Dash (DASH), Ethereum (ETH), and TRON (TRX) for now. We are working to get more assets on the platform.</div>
  </div>
  
  <div class="faq-item">
    <div class="question">How does Ltechng.co ensure account security?</div>
    <div class="answer">Ltechng.co prioritizes account security through multiple layers of protection. Accounts require a password to log in, ensuring only authorized users access their accounts. Furthermore, transactions are safeguarded by a Transaction PIN, adding an extra layer of security. Additionally, users are required to set up 2FA (Two-Factor Authentication) for added protection against unauthorized access.</div>
  </div>
  
  <div class="faq-item">
    <div class="question">How do I set my transaction PIN?</div>
    <div class="answer">Login into your dashboard and navigate to Account Settings. Swipe down to Account security and click on Reset PIN. Input your account password and your 6-digit Transaction PIN and click on update PIN.</div>
  </div>
  
  <div class="faq-item">
    <div class="question">How do I set up my Virtual dollar or naira card?</div>
    <div class="answer">On your dashboard, move down to LtechNG Trade on the side Nav Bar and click on Virtual card. Select Card type, enter BVN and your 6-digit transaction PIN and click on proceed.</div>
  </div>
  
  <div class="faq-item">
    <div class="question">How long does it take to get airtime/data when I purchase on your site?</div>
    <div class="answer">Our systems are fully automated to make every transaction instant with server uptime 24/7.</div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const questions = document.querySelectorAll(".question");
    questions.forEach(question => {
      question.addEventListener("click", function() {
        const answer = this.nextElementSibling;
        if (answer.style.display === "block") {
          answer.style.display = "none";
        } else {
          answer.style.display = "block";
        }
      });
    });
  });
</script>

</body>
</html>






							<!-- QUESTIONS HOLDER -->
							 
						</div>	<!-- End row -->
					</div>	<!-- END FAQs-1 QUESTIONS -->	


					<!-- MORE QUESTIONS -->	
					 
				</div>	   <!-- End container -->		
			</section>	<!-- END FAQs-1 -->


 