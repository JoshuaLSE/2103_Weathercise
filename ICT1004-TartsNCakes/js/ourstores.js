/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 */

//Code within this will only run once DOM is ready
// Shorthand for $(document).ready() is $(function(){});
$(document).ready(function ()
{
    //Register event handlers for the thumbnail popup images.
    document.getElementById("myBtn1").addEventListener("click", Btn1);
    document.getElementById("myBtn2").addEventListener("click", Btn2);
    document.getElementById("myBtn3").addEventListener("click", Btn3);
    console.log("JS loaded & Ready!");
});

//Singapore
function Btn1() {
    document.getElementById("card-img").src = "images/localbake.jpg";
    document.getElementById("card-title").innerHTML = "Tarts N' Cakes";
    document.getElementById("card-body").innerHTML = "112 Telok Ayer St, Singapore 068581";
    document.getElementById("phone-link").href = "tel:123-456-789";
    document.getElementById("card-operating").innerHTML = "07 30 - 22 30";
}

//Malaysia
function Btn2() {
    document.getElementById("card-img").src = "images/malaysia.png";
    document.getElementById("card-title").innerHTML = "Fyrestone Bakery";
    document.getElementById("card-body").innerHTML = "Jalan Serangkai 2, Taman Bukit Dahlia, 81700 Pasir Gudang, Johor, Malaysia";
    document.getElementById("phone-link").href = "tel:456-789-101";
    document.getElementById("card-operating").innerHTML = "10 30 - 22 30";
}

//Taiwan
function Btn3() {
    document.getElementById("card-img").src = "images/taiwanBake.PNG";
    document.getElementById("card-title").innerHTML = "Beigang Bakery";
    document.getElementById("card-body").innerHTML = "No. 102號, Section 2, Beigang Road, Taibao City, Chiayi County, Taiwan 612";
    document.getElementById("phone-link").href = "tel:111-213-141";
    document.getElementById("card-operating").innerHTML = "08 30 - 22 30";
}