$(document).ready(function(){
    console.log("admin panel");
   
   var urlDoAdmin="http://localhost/carrental/";
    let location = this.location.href;
    console.log(location);

    outputAllUsers();
    outputAllVehicles();
    $("#addVehicle").click(outputAddFormVehicle);
  
});

    function outputAddFormVehicle(e){
        e.preventDefault();
        $("#dataCarsAdd").slideDown("slow");
        $('html,body').animate({
            scrollTop: $("#dataCarsAdd").offset().top
        },'fast');
        $("#editCarForm").slideUp("slow");
    }
    
    function outputAllVehicles(){
        var urlDoAdmin="http://localhost/carrental/";
        console.log("korisnici");
        $.ajax({
            url: urlDoAdmin + "models/vehicles/get_all.php",
            dataType:"json",
            method:"post",
            success:function(data){
                
                $(".updateCar").click(outputOneCar);           
    
                $("#hideUpdateCars").click(function(){
                    $("#editCarForm").slideUp("slow");
                });
                $("#hideFormAddCars").click(function(){
                    $("#dataCarsAdd").slideUp("slow");
                 });
    
            },
            error:function(xhr,status,data){
                console.log(xhr.status + status);
            }
        });
    }
    function outputOneCar(e){
        e.preventDefault();
        var urlDoAdmin="http://localhost/carrental/";
    console.log("edit");
        $("#editCarForm").slideDown('slow');
        $("#dataCarsAdd").slideUp("slow");
        $('html,body').animate({
            scrollTop: $("#editCarForm").offset().top
        },'fast');
    
        var id=$(this).data('id');
            $.ajax({
                url : urlDoAdmin+"models/vehicles/get_one.php",
                method : "POST",
                dataType:"json",
                data:{
                    id:id
                },
                success : function(data,status, xhr) {
                console.log(data);

                    $("#modelUpdate").val(data.model)
                    $("#dailyPriceUpdate").val(data.price_per_day)
                    $("#constructionYearUpdate").val(data.construction_year)
                    $("#numberSeatsUpdate").val(data.number_seats)
                    $("#ddlFuelTypeUpdate").val(data.id_fuel_type)
                    $("#ddlBrandUpdate").val(data.id_brand);
                    $("#ddlTypeUpdate").val(data.id_type);
                    $("#skrivenoPoljeVehicle").val(data.id_vehicle);
    
                    console.log(xhr.status);
    
                    if(xhr.status == 201){
                        alert("Successfully updated vehicle!");
                    }
                   
                },
                error : function(xhr, status, error) {
                    switch(xhr.status){
                        case 404:
                        console.log("Page not found");
                        break;
                    case 500:
                        console.log("Server error.Currently cant't refresh data about customers");
                        break;
                    default:
                        console.log("Error:"+xhr.status+"-"+status);
                        break;
                    }
                    console.log(xhr.responseText)
                        console.log(xhr.status)
                }
            });
    }
    
    $(".deleteCar").on("click",deleteCar);
    function deleteCar(e){
        var urlDoAdmin="http://localhost/carrental/";
        e.preventDefault();
        let poslati=confirm("Are you sure that you want to delete this vehicle?");
        let vehicle=$(this).data("id");
        console.log("Vehicle: " + vehicle);
         if(poslati){
             console.log("Obrisano");
            $.ajax({
                 url: urlDoAdmin+"models/vehicles/delete.php",
                method:"post",
                dataType:"json",
                data:{
                    id:vehicle
                },
                success:function(data){
                        console.log(data);
                         window.location.reload();
                },
                error:function(xhr,status,data){
                        console.log(xhr.status + status);
                        window.location.reload();
                }
            });
         }
   }
//------------------- ISPIS KORISNIKA ---------------//
    function outputAllUsers(){
        var urlDoAdmin="http://localhost/carrental/";
        console.log("korisnici");
        console.log("korisnici");
        $.ajax({
            url: urlDoAdmin + "models/customers/get_all.php",
            dataType:"json",
            method:"post",
            success:function(data){
                $(".obrisi").click(deleteUser);
                $(".podaciJedanKorisnik").click(outputOneUser);
    
                    $("#hideForm").click(function(){
                        $("#podaci").slideUp("slow");
                     });
    
            },
            error:function(xhr,status,data){
                console.log(xhr.status + status);
                // alert("greska ispisSvih korisnika");
            }
        });
    }
    function deleteUser(e){
        var urlDoAdmin="http://localhost/carrental/";
        console.log("OBRISI");
        e.preventDefault();
        let poslati=confirm("Are you sure that you want to delete this customer?");
        let id=$(this).data("id");
            if(poslati){
                $.ajax({
                    url : urlDoAdmin+"models/customers/delete.php",
                    method : "post",
                    data:{
                        id:id
                    },
                    success:function(data){
                       outputAllUsers();
                        window.location.reload();
                    },
                    error:function(xhr,status,data){
                        if(xhr.status==409){
                            $(".odgovorUpdate").html("You cant't delete this customer");
                        } 
                        else{
                            console.log(xhr.status + status);
                        }
                    }
                });
             }
    }

//---------- KORISNICI ---------------//


function outputOneUser(e){
    var urlDoAdmin="http://localhost/carrental/";
    console.log("edit");
    console.log("edit");

    e.preventDefault();
    $("#podaci").slideDown("slow");
    var id=$(this).data('id');
    console.log(id);
        $.ajax({
            url : urlDoAdmin+"models/customers/get_one.php",
            method : "post",
            dataType:"json",
            data:{
                id:id
            },
            success : function(data) {
                console.log(data);
                $("#tbIme").val(data.name);
                $("#tbPrezime").val(data.surname);
                $("#tbEmail").val(data.email);
                $("#tbUsername").val(data.username);
                $("#tbPhone").val(data.phone_number);
                $("#ddlUloga").val(data.id_role);
                $("#skrivenoPolje").val(data.id_user);
            },
            error : function(xhr, status, error) {
                switch(xhr.status){
                    case 404:
                        console.log("Page not found");
                        break;
                    case 500:
                        console.log("Server error.Currently cant't refresh data about customers");
                        break;
                    default:
                        console.log("Error:"+xhr.status+"-"+status);
                        break;
                }
            }
        });

} 