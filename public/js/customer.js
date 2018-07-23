$showButton = document.getElementById("show-customer-info-btn");
$customerInfo = document.getElementById("show-customer-info");
$closeButton = document.getElementById("close-customer-info");

$showButton.addEventListener( "click" , function() {
    $customerInfo.hidden = false;
});

$closeButton.addEventListener( "click" , function() {
    $customerInfo.hidden = true;
});
