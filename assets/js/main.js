/*** IIFE function ***/
$(document).ready(function(){

    console.log("Work");
    var url="http://localhost/carrental/";
    let location = this.location.href;
    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

   /*------------------
        Scroll, navigation and mobile view
    --------------------*/
    $(window).scroll(function(){
        let top = $(this)[0].scrollY;
        if(top > 530){
            $("#scrollTop").show();
        } else {
            $("#scrollTop").hide();
        }

        if(top > 530){
            $("#menu").css({
                "background-color": "#272727",
            });
            $("#menu .nav a").css({
                "color": "#888888",
            });
            $("#menu #logoHeader a").css({
                "color": "#fff",
            });
        }
        else{
            $("#menu").css({"background-color": '#fff'});
            $("#menu #logoHeader a").css({
                "color": "#000",
            });
        }
    });
    $("#mob").hide(), 
	$("#mob li a").click(() => {
        $("#mob").slideUp('medium')
    })
    
    $("#hamburgerIkonica").addClass('senka').on("click", (() => {
        $("#mob").animate({
            width: "toggle"
        })
       /** setting logo for mobile devices with click on "hamburger" icon**/
        var slikaLogoMob = `<a href="http://localhost/carrental/index.php">
                                <img src="assets/images/logo1Mob.png" alt="logo" class="logoMob"/>
                            </a>`;
        var logoMob = document.getElementsByClassName("logoHeaderMob");
        for(let i=0;i<logoMob.length;i++){
            logoMob[i].innerHTML =  slikaLogoMob;
        }
    }))

    console.log("onload js");
    if(window.location.href==url+"index.php?page=home" || window.location.href==url+"index.php?page=home#" || window.location.href==url || window.location.href==url + "index.php" || window.location.href==url + "#titleAbout"){
        console.log("index");
    //slider - header
            let slideNumber = 1;
            showSlide(slideNumber);

            const s = selektor => document.querySelector(selektor);
            EventTarget.prototype.on = EventTarget.prototype.addEventListener;
            function giveClickEventToArrows(id, value){
                s(`#${id}`).addEventListener("click", ()=>{
                    showSlide(slideNumber += value);
                })
            }
            giveClickEventToArrows("left", -1);
            giveClickEventToArrows("right", 1);

            function giveClickEventToCircles(id, value){
                s(`#${id}`).addEventListener("click", ()=>{
                    showSlide(slideNumber = `${value}`);
                })
            }
            giveClickEventToCircles("dot1", 1);
            giveClickEventToCircles("dot2", 2);
            giveClickEventToCircles("dot3", 3);

        

            function showSlide(n){
                let i;
                let slides = document.getElementsByClassName("show");
                let circles = document.getElementsByClassName("circle");

                if(n > slides.length){
                    slideNumber = 1;
                }
                if(n < 1){
                    slideNumber = slides.length ;
                }
                for(i = 0; i < slides.length; i++){
                    slides[i].style.display = "none";
                }
                for (i = 0; i < circles.length; i++) { 
                    circles[i].className = circles[i].className. 
                                        replace(" active", ""); 
                } 
                slides[slideNumber - 1].style.display = "block";
                circles[slideNumber - 1].className += " active"; 
            }


    }

    $('[data-toggle="tooltip"]').tooltip();
    var date = new Date();
    const thisYear = date.getFullYear();
    $(".yearCopyright").html(thisYear);

    $("#more").hide();
    $("#showMoreCars").click(function(e) {
        e.preventDefault();
        $("#more").slideToggle(500);
        console.log("more");
    });
    $(".renting").hide();
    $("#btnAddRent").click(function(e) {
        e.preventDefault();
        $(".renting").slideToggle(500);
        console.log("more");
    });

    $("#rentObican").click(function(){
        alert("You need to be logged in in order to rent");
    })
    $("#btnAddRentNot").click(function(){
        alert("We currently have no available vehicles of this type. Please take a look at some similar vehicle until this is in stock.");
    })

     //---------------------------- RENT VEHICLES --------------------------------------//
     $("#btnAddRent").click(ispisiAddFormuRent);
     function ispisiAddFormuRent(e){
         console.log("add rent");
         e.preventDefault();
         $("#formaRent").slideToggle("500");
     }
     
     $("#btnSendRent").on("click", sendRent);
     function sendRent(e){
         console.log("send rent");
         e.preventDefault();
         let startDate = $("#startdate").val();
         let endDate = $("#enddate").val();
         let vehicle = $(this).data("vehicle");
         let dailyPrice = $(this).data("dailyprice");

         console.log("Start date: " + startDate);
         console.log("End date: " + endDate);
         console.log("daily Price: " + dailyPrice);

         let startGreska = document.querySelector("#datumGreskaStart");
         let endGreska = document.querySelector("#datumGreskaEnd");

         let errors=[];
         let valid=true;

         if(startDate == ''){
             errors.push("<b>The field for the start date of rent is required!");
             startGreska.textContent = "The field for the start date of rent is required!";
             valid = false;
         }
         if(endDate == ''){
             errors.push("<b>The field for the end date of rent is required!</b>");
             endGreska.textContent = "The field for the end date of rent is required!";
             valid = false;
         }
        var price;
        var dateStart = new Date(startDate); 
        var dateEnd = new Date(endDate); 
    
        var differenceInTime = dateEnd.getTime() - dateStart.getTime(); 
        var differenceInDays = differenceInTime / (1000 * 3600 * 24);
        console.log(differenceInDays);

        var sumPrice = dailyPrice * differenceInDays;
        if(differenceInDays > 3){
            price = sumPrice - 5/100 * sumPrice;
        }else if(differenceInDays > 5){
            price = sumPrice - 7/100 * sumPrice;
        }
        else if(differenceInDays > 10){
        price = sumPrice - 10/100 * sumPrice;
        }else{
            price = sumPrice;
        }
        console.log(price);

         $.ajax({
             url: url+"models/renting/rent.php",
             method: "POST",
             dataType: "json",
             data: {
                 start: startDate,
                 end: endDate,
                 vehicle: vehicle,
                 dailyprice: dailyPrice,
                 price: price,
                 send: true
             },
             success: function (data) {
                 console.log(data);
                 console.log(data.message);
                 if(data == "success change availability" || data == "success sent request"){
                     
                     alert("Rent request successfully sent");
                     document.getElementById("startdate").value="";
                     document.getElementById("enddate").value="";
                     window.location.reload();
                    //  window.location.replace('http://localhost/carrental/index.php?page=vehicle.php?id='+vehicle);
                 }
             },
             error: function (xhr, error,status) {
                 let code = xhr.status;
                 console.log(xhr.responseText);
                 switch (code) {
                     case 500:
                         console.log("Server error, please try again");
                         break;
                     default:
                         console.log("Error: " + code + ", " + error)
                         break;
                 }
             }
         })
     }

      //---------------------------- CATALOG --------------------------------------//
 
            //catalog - browse vehicles by model
            $("#search").keyup(function(){
                let value = this.value.toLowerCase();
                console.log(value);
                $.ajax({
                    url: "models/vehicles/search.php",
                    method: "POST",
                    dataType:"json",
                    data:{
                        keyword:value
                    },
                    success: function(data){
                        console.log(data);
                        outputCars(data);
                        if((data.cars).length == 0){
                            $("#allCars").html("<h2 class='text-black'>Sorry, the car with your search doesn't exists yet in our catalog. Please contact administrator in case you want to add that car to our collection...</h2>");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        console.log(xhr.responseText);
                        console.log(xhr.status);
                    }
                });
            });

      
      //  }
      //---------------------------- // END CATALOG --------------------------------------//

       //all cars
    function outputCars(data){
        let html = ` <div class="row" id="cars">`;
        for(let car of data.cars){
            html += `<article class="aSection col-12 col-sm-6 col-md-4 col-lg-3 ">
                        <figure class="imgCars">
                            <img src="${car.carPicture}" alt="${car.carModel}" class="img-fluid"/>
                        </figure>
                        <div class="descSection">
                            <h3><strong>${car.carBrand}</strong>, ${car.carModel}</h3>
                            <p>Type: ${car.type}</p>
                            <p>Daily price: ${car.dailyPrice}</p>
                        </div>
                            <a class="button aboutBtn" href="index.php?page=vehicle&id=${car.id}"  data-id="${car.id}">
                                <span class="btnInner mbBtn">
                                    Read more
                                </span>
                            </a>
				</article>`;
        }
        html+=`</div>`;
        $("#allCars").html(html);
        }

            //---------------------------- REGISTER --------------------------------------//
            if(window.location.href==url+"index.php?page=register" || window.location.href==url+"index.php?page=register#"){
                //------------------ registration ----------------//
                    $("#btnRegistracija").on("click",function(){
                        console.log("btnRegister");
                        // alert("btn");
        
                        function unosKorisnika(){
                            console.log("inseert");
                            // alert("insert");
        
                            let ime=$("#ime").val();
                            let prezime=$("#prezime").val();
                            let email=$("#email").val();
                            let username=$("#username").val();
                            let lozinka=$("#lozinka").val();
                            let telefon=$("#telefon").val();
                    
                            let reIme = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,29}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,29})*$/;
                            let rePrezime = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,49}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,49})*$/;
                            let reEmail = /^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/;
                            let reUsername = /^[\d\w\_\-\.]{4,30}$/;
                            let reLozinka = /^\S{5,50}$/;
                            let reTelefon = /^[+]?[\d]{10,13}$/;
                    
                            var errors=[];
                            var valid=true;
             
                            let imeGreska = document.querySelector("#imeGreskaRegister");
                            let prezimeGreska = document.querySelector("#prezimeGreskaRegister");
                            let usernameGreska = document.querySelector("#usernameGreskaRegister");
                            let emailGreska = document.querySelector("#emailGreskaRegister");
                            let lozinkaGreska = document.querySelector("#lozinkaGreskaRegister");
                            let telefonGreska = document.querySelector("#telefonGreskaRegister");
                        
            
                          
                            if(ime == ''){
                                errors.push("<b class='text-bela'>The field for name is required!</b>");
                                imeGreska.textContent = "The field for name is required!";
                                valid = false;
                            }else {
                                if(!reIme.test(ime)){
                                    valid = false;
                                    errors.push("<b class='text-bela'>Name has to start with uppercase and person can write in it more name </b>");
                                    imeGreska.textContent = "*Name has to start with uppercase and person can write in it more name";
                                }else{
                                    imeGreska.textContent = "";
                                }
                            }
        
                            if(prezime == ''){
                                errors.push("<b class='text-bela'>The field for surname is required!</b>");
                                prezimeGreska.textContent = "The field for surname is required!";
                                valid = false;
                            }else {
                                if(!rePrezime.test(prezime)){
                                    valid = false;
                                    errors.push("<b class='text-bela'>Surname has to start with uppercase and person can write in it more name </b>");
                                    prezimeGreska.textContent = "*Surname has to start with uppercase and person can write in it more surname";
                                }else{
                                    prezimeGreska.textContent = "";
                                }
                            }
        
                            if(username == ''){
                                errors.push("<b class='text-bela'>The field for username is required!</b>");
                                usernameGreska.textContent = "The field for username is required!";
                                valid = false;
                            }else {
                                if(!reUsername.test(username)){
                                    valid = false;
                                    errors.push("<b class='text-bela'>Username is free mind (symbol @ isn't supported) </b>");
                                    usernameGreska.textContent = "*Username is free mind (symbol @ isn't supported)";
                                }else{
                                    usernameGreska.textContent = "";
                                }
                            }
                    
                            if(email==''){
                                errors.push("<b class='text-bela'>The field for email is required!</b>");
                                emailGreska.textContent="The field for email is required!";
                                valid = false;
                            }else {
                                if(!reEmail.test(email)){
                                    valid = false;
                                    errors.push("<b class='text-bela'>Email address  has to be in format for example. -> somebody@gmail.com </b>");
                                    emailGreska.textContent="*Email address  has to be in format for example. -> somebody@gmail.com";
                                }else{
                                    emailGreska.textContent = "";
                                }
                            }
        
                            
                        if(lozinka == ''){
                            errors.push("<b class='text-bela'>The field for password is required!</b>");
                            lozinkaGreska.textContent = "The field for password is required!";
                            valid = false;
                        }else {
                            if(!reLozinka.test(lozinka)){
                                valid = false;
                                errors.push("<b class='text-bela'>Password has to have more than 8 characters</b>");
                                lozinkaGreska.textContent = "*Password has to have more than 8 characters";
                            }else{
                                lozinkaGreska.textContent = "";
                            }
                        }
                             
                        if(telefon == ''){
                            errors.push("<b class='text-bela'>The field for phone No is required!</b>");
                            telefonGreska.textContent = "The field for phone no is required!";
                            valid = false;
                        }else {
                            if(!reTelefon.test(telefon)){
                                valid = false;
                                errors.push("<b class='text-bela'>Phone No has to have between 10 and 13 characters</b>");
                                telefonGreska.textContent = "*Phone No has to have between 10 and 13 characters";
                            }else{
                                telefonGreska.textContent = "";
                            }
                        }
                    
                            if(errors.length){
                                let ispis=`<ul>`;
                                    for(let greska of errors){
                                        ispis+=`<li>${greska}</li>`
                                    }
                                    ispis+=`</ul>`;
                                    $("#poruka").html(ispis);
                            }
                            
                            var obj={
                                ime:ime,
                                prezime:prezime,
                                email:email,
                                username:username,
                                lozinka:lozinka,
                                telefon:telefon,
                                send:true
                            };
                            return obj;
                        }
                    
                        function callAjax(obj){
                            console.log("ajax");
                            $.ajax({
                                url : "models/register.php",
                                method : "POST",
                                dataType:"json",
                                data:obj,
                                success : function(data) {
                                    console.log(data);
                                    if(data.message=="User successfully registred"){
                                        alert("Successful registration");
                                    $("#poruka").html("Successful registration");
                                    
                                    window.location.replace('http://localhost/carrental/index.php?page=login');
                                    }
                                    
                                },
                                error : function(xhr, status, error) {
                                    let poruka="Doslo je do errors";
                                    console.log(status);
                                    // alert(poruka);
                                        switch(xhr.status){
                                            case 404:
                                                poruka="Page not found";
                                                break;
                                            case 409:
                                                poruka="Username or email already exists";
                                                break;
                                            case 422:
                                                poruka="Data not valid";
                                                break;
                                            case 500:
                                                poruka="Server error";
                                                break;
                                        }
                                        $("#poruka").html(poruka);
                                        console.log(poruka);
                                        console.log(xhr.responseText)
                                        console.log(xhr.status)
                                }
                            });
                        }
                        var formData = unosKorisnika();
                        callAjax(formData);
                    });
                }
        
              
        
                //------------------------------------ Logovanje ---------------------------------//
               if(window.location.href==url+"index.php?page=login" || window.location.href==url+"index.php?page=login#"){
                    $("#btnLogin").click(proveraLogin);
                    function proveraLogin(){
                        console.log("btnLogin");
                        console.log("insert");
                        
                        let email=$("#tbEmail").val();
                        let lozinka=$("#tbLozinka").val();
                    
                        let reEmail = /^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/;
                        let reLozinka = /^\S{5,50}$/;
        
                        let emailGreska = document.querySelector("#emailGreskaLogin");
                        let lozinkaGreska = document.querySelector("#lozinkaGreskaLogin");
                    
                        var errors=[];
                        var valid = true;
        
                        if(lozinka == ''){
                            errors.push("<b class='text-bela'>The field for password is required!</b>");
                            lozinkaGreska.textContent = "The field for password is required!";
                            valid = false;
                        }else {
                            if(!reLozinka.test(lozinka)){
                                valid = false;
                                errors.push("<b class='text-bela'>Password has to have more than 8 characters</b>");
                                lozinkaGreska.textContent = "*Password has to have more than 8 characters";
                            }else{
                                lozinkaGreska.textContent = "";
                            }
                        }
                
                        if(email==''){
                            errors.push("<b class='text-bela'>The field for email is required!</b>");
                            emailGreska.textContent="The field for email is required!";
                            valid = false;
                        }else {
                            if(!reEmail.test(email)){
                                valid = false;
                                errors.push("<b class='text-bela'>Email address  has to be in format for example. -> somebody@gmail.com </b>");
                                emailGreska.textContent="*Email address  has to be in format for example. -> somebody@gmail.com.";
                            }else{
                                emailGreska.textContent = "";
                            }
                        }
                    
                        if(errors.length){
                            let ispis='';
                            for (let i = 0; i < errors.length; i++) {
                                ispis+=errors[i] + "<br>";
                            }
                            $("#porukaerrorsLogin").html(ispis);
                        }else{
                            $.ajax({
                                url:url+"models/login.php",
                                method:"post",
                                data:{
                                    email:email,
                                    lozinka:lozinka,
                                    send:true
                                },
                                success:function(data){
                                    console.log(data);
                                    $("#tbEmail").val("");
                                    $("#tbLozinka").val("");
                                    alert("Successfully login to our website!");
                                    window.location.reload();
                                    $("#poruka").html("Successfully login to our website!");
                                    if(data == "customer"){
        window.location.replace('http://localhost/carrental/index.php?page=home');
                                    }else{
        window.location.replace('http://localhost/carrental/views/pages/admin.php');
        
                                    }
                                    
                                },
                                error:function(xhr,status,data){
                                    console.log(xhr.status + status);
                                    console.log(xhr.responseText)
                                    $("#tbEmail").val("");
                                    $("#tbLozinka").val("");
                                    window.location.reload();
                                    let poruka = "Some error is made...";
                                    window.location.replace('http://localhost/carrental/index.php?page=home');
                                    switch(xhr.status){
                                        case 404:
                                            poruka="Page not found";
                                            break;
                                        case 422:
                                            poruka="To login, first you need to be registred..!";
                                            window.location.replace('http://localhost/carrental/index.php?page=register');
                                            break;
                                        case 500:
                                            poruka="Server error, please contact the administrator";
                                            break;
                                    }
                                    $("#porukaerrorsLogin").html(poruka);
                                    console.log(poruka);
                                }
                            });
                        }
                    }
                }  

       
        

});    
