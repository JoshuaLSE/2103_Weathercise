/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//const ID_POPUP = "id_popup";
//
//$( document ).ready(function() 
//{
//
//    registerEventHandler();
//});
//
//function registerEventHandler()
//{
//	var thumbnails = document.getElementsByClassName("img-thumbnail"); //returns an array called thumbnails
//        if (thumbnails !== null)
//	{
//		var counter = 0;
//		for (var counter; counter < thumbnails.length; counter += 1)
//		{
//			var thumbnail = thumbnails[counter];
//			thumbnail.addEventListener("click", togglePopup);
//		}
//	}
//	else
//	{
//		console.log("No thumbnail images found!");
//	}
//}
//
//function togglePopup(event)
//{
//	var popup = document.getElementById(ID_POPUP);
//	if (popup === null)
//	{
//		popup = document.createElement("span");
//		popup.id = ID_POPUP;
//		popup.setAttribute("class", "img-popup");
//		var thumbnail = event.target;
//		var image = thumbnail.src; 
//		//var big_image = small_image.replace("_small", "_large");
//		popup.innerHTML = '<div class = "container">'+
//                                  '<img src=' + image + '>' +
//                                  '<h3>'+ document.getElementsByClassName("desc").textContent +'</h3></a>'+
//                                  '<a class="btn btn-primary" href="#" role="button">Add To Cart</div>';
//		thumbnail.insertAdjacentElement("afterend", popup);
//	}
//	else
//	{
//		$("#" + ID_POPUP).remove();
//	}
//}

var modal = document.getElementById("myModal");
var checkout = document.getElementById("checkoutBtn");
// Get the image and insert it inside the modal - use its "alt" text as a caption
var images = document.getElementsByClassName("img-thumbnail");
var modalImg = document.getElementById("img01");
var nameText = document.getElementById("name-content");
var descModal = document.getElementById("desc-content");
var priceModal = document.getElementById("price-content");
var itemID = document.getElementById("itemID");
//  Loop through all the images from carousel until someone clicks on an img
for (var i = 0; i < images.length; i++) {
    var img = images[i];
    img.onclick = function () {
        var j = this.id;
        var desc = document.getElementById("idDesc" + j + "").textContent;
        var price = document.getElementById("idPrice" + j + "").textContent;
        modal.style.display = "block";
        modalImg.src = this.src;
        modalImg.id = j;
        nameText.innerHTML = this.alt;
        descModal.innerHTML = desc;
        priceModal.innerHTML = "$" + price + "";
        itemID.value = j;
    };
}

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
//span.onclick = function () {
//    modal.style.display = "none";
//}

window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

checkout.onclick = function(){
    alert("Added To Cart");
    
};