const BASEURL = "data/";

var url = window.location.search;
console.log(url)
let buttonCloseModal = document.getElementById("closeModal");
let modalCart = document.getElementById("modalCart");
let buttonCart = document.getElementById("cart");
if(buttonCart!=null){
    buttonCart.addEventListener("click",function(){
        if(modalCart.hasAttribute("class")){
            modalCart.classList.remove("block");
            modalCart.removeAttribute("class");
        }
        else {
            modalCart.classList.add("block");
            $("#modalContent").html( showProducts)
        }
    });
}
if(buttonCloseModal!=null){
    buttonCloseModal.addEventListener("click",function(){
        modalCart.classList.remove("block");
        modalCart.removeAttribute("class");
    });
}
//callback funkcija
function ajaxCallBack(url,method,result){
    $.ajax({
        url: url,
        method: method,
        dataTyte: "json",
        success: result,
        error: function(x){     
            let buttonCloseModalError = document.getElementById("closeModal4");
            let modalError = document.getElementById("modalError");
                buttonCloseModalError.addEventListener("click", function(){
                modalError.classList.add("block")
                $("#cont").html(x)
            })
        }
    });
}

function ajaxCallBackPHP(url,method,data,result){
    $.ajax({
        url: url,
        method: method,
        dataTyte: "json",
        data: data,
        success: result,
        error: function(x){     
            let buttonCloseModalError = document.getElementById("closeModal4");
            let modalError = document.getElementById("modalError");
                buttonCloseModalError.addEventListener("click", function(){
                modalError.classList.add("block")
                $("#cont").html(x)
            })
        }
    });
}
//local storage
function saveToLocalStorage(naziv, vrednost){
    localStorage.setItem(naziv, JSON.stringify(vrednost));
}
function getFromLocalStorage(naziv){
    return JSON.parse(localStorage.getItem(naziv));
}
// ajaxCallBack(BASEURL+"navigation.json","get",function(result){
//     //printNavigation(result, "#navigation");
//     //printNavigation(result, "#list");
// });
// ajaxCallBack(BASEURL+"social.json","get",function(result){
//     printSocialNetwork(result);
// });
let productsCart = getFromLocalStorage("cart")
if(productsCart!=null){
    let number = productsCart.length
    $("#broj").html(`${number}`)
}
else{
    $("#broj").html(`0`)
}
//funkcija za ispis navigacije
// function printNavigation(x, id){
//     let ispis = "";
//     for(let el of x){
//         ispis+=`<li class=""><a class="d-flex justify-content-center" href="${el.href}">${el.text}</a></li>`;
//     }
//     //$(id).html(ispis);
// }
//funkcija za ispis socijalnih mreza u futeru
function printSocialNetwork(x){
    let ispis = "";
    for(el of x){
        ispis+=`<li><a href="${el.href}"><span class="${el.className}"></span> ${el.name}</a></li>`
    }
    $("#social").html(ispis);
}
//single stranica
if(url.indexOf("single")!=-1 ||  url=="single"){
    let urlParametar = new URLSearchParams(window.location.search)
    let productId = urlParametar.get("id")
    var brands = []
    var products= []
    var colors = []
    var types = []
    window.onload = function(){
       
    }
    let dugme = document.getElementById("add-to-cart-button");
    dugme.setAttribute("data-id", productId);
    dugme.addEventListener("click",addToCart)
    dugme.addEventListener("click",addToCartAnimation)
    dugme.addEventListener("click",showProducts)
    
    function nadji(data){
        let products = data;
       
        var trazeniProizvod = products.find(function(p) {
            return p.id == productId;
        });
        $("#slika").attr("src", trazeniProizvod.image.src)
        $("#naziv").html(trazeniProizvod.name)
        $("#opis").html(trazeniProizvod.description)
        $("#nova").html(trazeniProizvod.price.current+" &euro;")
        $("#stara").html(trazeniProizvod.price.old!=null?trazeniProizvod.price.old+" &euro;":"") 
        $("#add-to-cart-button").attr("data-id",trazeniProizvod.id);
    }
   
    dugme.addEventListener("click",addToCart)
    dugme.addEventListener("click",addToCartAnimation)
    dugme.addEventListener("click",showProducts)
    setInterval(function(){
        if(getFromLocalStorage("cart")!=null){
            $("#preusmeri").addClass("block")
        }else{
            $("#preusmeri").removeClass("block")
        }
    },100)
    setInterval(function(){
        if(getFromLocalStorage("cart")!=null){
            $("#obrisi").addClass("block")
        }else{
            $("#obrisi").removeClass("block")
        }
    },100)
    
   
}
if(url.indexOf("home")!=-1 || url=="/index.php" || url=="/"){
    // window.onload = function(){
    //     ajaxCallBack(BASEURL+"products.json","get",function(result){
    //         top6Products(result, "#trend")
    //     })
    // }
    function top6Products(x, id){
        let ispis =""
        let sortiran = []
        sortiran = x.sort(function(a,b){
            return b.stars - a.stars
        })
        let prvih6 = sortiran.slice(0,6)

        for(let e of prvih6){
            ispis+=`
                    <div class="col-md-4 col-sm-6 gal-img"> 
                    <a class="link" href="single.php?id=${e.id}">
                        <img src="${e.image.src}" alt="${e.image.alt}" class="img-fluid mt-4"><br/>
                        <ul class="stars d-flex justify-content-center">
                                    ${countOfStars(e.stars)}
                        </ul>
                    </a>
                    </div>
                   `
        }
        $(id).html(ispis)
    }
    function countOfStars(x){
        let ispis=""
        for(let i=1 ; i<=5;i++){
            if(i<=x){
                ispis+=`<li><span class="fa fa-star" aria-hidden="true"></span></li>`
            }
            else if(i>x && parseInt(x)==i-1 && x%(i-1)!=0){
                ispis+=`<li><span class="fa fa-star-half-o" aria-hidden="true"></span></li>`
            }
            else{
                ispis+=`<li><span class="fa fa-star-o" aria-hidden="true"></span></li>`
            } 
        }
        return ispis
       }
}
//stranica za shop
if(url.indexOf("shop")!=-1 ||  url=="?page=shop"){
    
    window.onload = function(){
       localStorage.setItem("active",0)
       console.log(localStorage.getItem("active"))
       $.ajax({
            url:"models/artikliZaKorpu.php",
            method:"POST",
            type:"JSON",
            success:function(result){
               saveToLocalStorage("artikli", result)
                //console.log(getFromLocalStorage("artikli"))
            },
            error:function(x){
                console.log(x);
            }
        
       })

        $.ajax({
            url:"models/filteri.php",
            method:"POST",
            type:"JSON",
            data:{
                    vrati : 1
                },
            success:function(result){
                let p = JSON.parse(result)
                printProducts(p.proizvodi, p.promocije, p.staraCena, p.popusti)
                localStorage.setItem("brojProizvoda", p.ukupno)
            },
            error:function(x){
                console.log(x);
            }
       }) 
       $(".strana").click(strane)
     
    }
    

    function ajaxCallBack(url, method, data, result) {
        $.ajax({
          url: url,
          method: method,
          data: data,
          dataType: "json",
          success: result,
          error: function (error) {
          },
        });
    }
      
      
    
      
    
    $('ul li a').click(function() {
        $('ul li a.active2').removeClass('active2');
        $(this).addClass('active2');
    });
    
    



    let chcBoxs = document.getElementsByClassName("chc");
    for(let i=0;i<chcBoxs.length;i++){
        chcBoxs[i].addEventListener("change", filteri);
    }
    

    $("#trazi").keyup(filteri)
    $("#sor").change(filteri)
    
    

    function strane(e){
        e.preventDefault();

        let marke = $('input[type=checkbox][name=marka]:checked').map(function() {
            return $(this).val();
        }).get();

        let boje = $('input[type=checkbox][name=boja]:checked').map(function() {
            return $(this).val();
        }).get();

        let kategorije = $('input[type=checkbox][name=kat]:checked').map(function() {
            return $(this).val();
        }).get();
      
        limit = $(this).data("limit")
        localStorage.setItem("active",limit)
        let brojProizvoda = 0
        
        ajaxCallBack("models/filteri.php", "post", {limit, marke, boje, kategorije}, function(result){
            let p = result
            printProducts(p.proizvodi, p.promocije, p.staraCena, p.popusti)
            brojProizvoda = result.length
        })
        
    }

    function filteri(){
        
        let marke = $('input[type=checkbox][name=marka]:checked').map(function() {
            return $(this).val();
        }).get();

        let boje = $('input[type=checkbox][name=boja]:checked').map(function() {
            return $(this).val();
        }).get();

        let kategorije = $('input[type=checkbox][name=kat]:checked').map(function() {
            return $(this).val();
        }).get();

       
        
        
        let unos = $("#trazi").val()
        var sort = $("#sor").val()

        $.ajax({
            url:"models/filteri.php",
            method:"POST",
            type:"JSON",
            data:{
                    marke : marke,
                    boje : boje,
                    kategorije : kategorije,
                    unos : unos,
                    sort : sort 
                },
            success:function(result){
                let p = JSON.parse(result)
                printProducts(p.proizvodi, p.promocije, p.staraCena, p.popusti)
                localStorage.setItem("brojProizvoda", p.ukupno)

                
                let ukupno = localStorage.getItem("brojProizvoda")
                ukupno = Math.ceil(ukupno/4)
                console.log(ukupno)
                if(ukupno !=1){
                    let ispisPaginacija = ""
                    for(let i=0 ; i<ukupno ; i++){
                        if(!i){
                            ispisPaginacija += `<li class="page-item"><a class="page-link strana active2" data-limit="${i}">${i+1}</a></li>`
                        }else{
                            ispisPaginacija += `<li class="page-item"><a class="page-link strana" data-limit="${i}">${i+1}</a></li>`
                        }
                    }
                    $(".pagination").html(ispisPaginacija)
                    $(".strana").click(strane)
                    $('ul li a').click(function() {
                        $('ul li a.active2').removeClass('active2');
                        $(this).addClass('active2');
                    });
                }else{
                    $(".pagination").html("")
                }
            },
            error:function(x){
                console.log(x);
            }
        
       })

       


    };



    
    //funkcija za stampanje proizvoda
    function printProducts(x, prom, cena, popust){
        let redObj = document.getElementById("baner");
        let z=0
        let b = 0
        if(x.length==0){
            redObj.innerHTML = `<div class="row">
                                    <div class="col-12">
                                         <p class="alert alert-danger mt-5">
                                         There is currently no product for the selected category</p>
                                    </div>
                                </div>`
        }
        else{
            
        let ispis=`
                   <h3 class="title-wthree mb-lg-2 mb-1 mt-4">Shop Now</h3>
                   <div class="row shop-wthree-info text-center">
                   `;
        
        for(let element of x){
            ispis += `<div class="col-lg-3 col-sm-6 shop-info-grid text-center mt-4 art" > 
                        <div class="col product-shoe-info shoe"><div class="aki">
                        <a class="link" href="index.php?page=single&id=${element.id_proizvod}">
                            <div class="men-thumb-item blk">
                            ${badge(prom[z])}
                                <img src="assets/images/product-images/thumbnail/${element.slika}" class="img-fluid" alt="${element.naziv}">
                            </div>
                            <div class="item-info-product gore">
                                <div class="nas">
                                    <h4>
                                       ${element.naziv}
                                    </h4>
                                </div>

                                <div class="product_price">
                                    <div class="grid-price">
                                        ${getPrice(cena[z].cena, popust[z].procenat)}
                                    </div>
                                </div>
                               
                                <h6 class="mt-4">${isFreeShipping(cena[z].cena,popust[z].procenat)}</h6>
                            </div>
                            </a>
                            </div>
                            <button class="add-to-cart-button" data-id="${element.id_proizvod}">Add to cart</button>
                        </div>
                        
                        
                    </div>`
                    z++
                    
                    if(!(++b%4 && b!=0)) {ispis += `</div><div class="row shop-wthree-info text-center">`}
        }
            redObj.innerHTML=ispis+="</div>";
            $(".add-to-cart-button").click(addToCart);
            $(".add-to-cart-button").click(addToCartAnimation);
            $(".add-to-cart-button").click(showProducts);
        }}
   //funkcija za vracanje trendinga, sta je novo, poslednji model
   function badge(x){
    
            if(x!=null){
                return `<div class="new ${x.boja}">${x.promocija}</div>`
            }
            else{
                return ""
            }
        
        
    } 
    
   //funkcija koja vraca cene
   function getPrice(cena, popust){
        //console.log(popust)
        let ispis =""
        if(popust>0){
            ispis+=`<span class="line">${cena}&euro;</span>&nbsp;&nbsp;<span class="money">${Math.round(cena * (1- (popust/100)),0)}&euro;</span><br/>
                   <span class="save">Save ${Math.round(cena - cena * (1- (popust/100)))}&euro;</span>`
        }
        else{
            ispis+=`<span class="money">${cena}&euro;</span>`
        }
        return ispis
   }
  
   
   //funkcija za proveru da li je dostava besplatna
   function isFreeShipping(x,y){
    let cena = x * (1-(y/100))
        let ispis="";
            if(cena>500){
                ispis = `Free shipping`
            }
        return ispis
   }
    //funkcija za ispis liste za sort
    function sortPrint(array, id){
        let ispis =""
        for(let i=0; i<array.length;i++){
            if(i==0){
                ispis+=`<option value="${i}" hidden>${array[i]}</option>`
            }
            else{
                ispis+=`<option value="${i}">${array[i]}</option>`
            }
        }
        $(id).html(ispis);
    }
    let nizSort = ["Select sort type","Sort by name A-Z","Sort by name Z-A"]
    sortPrint(nizSort,"#sor");
    let resetFilterObj = document.getElementById("reset")
    //resetFilterObj.addEventListener("click", resetFilters)
    function resetFilters(){
        let proizvodi = getFromLocalStorage("sviProizvodi");
        let ddlObj = document.getElementsByClassName("ddl")
        for(let d of ddlObj){
            d.selectedIndex=0
        }
        let chcObj = document.getElementsByClassName("chc")
        for(let c of chcObj){
            c.checked=false
        }
        let rangeValue = document.getElementById("rangeValue"); 
        rangeValue.value = findMaxPrice(getFromLocalStorage("sviProizvodi"))
        var slider = document.getElementById("range"); 
        slider.value = slider.max;       
        //printProducts(proizvodi)
    } 
}
if(url.indexOf("contact")!=-1 || url=="?page=contact"){
    window.onload=function(){
        // ajaxCallBack(BASEURL+"cities.json","get",function(result){
        //     printCities(result,"#sel5");
        // });
        let dugme = document.getElementById("dugme")
        dugme.addEventListener("click", obradaForme)
    }
    function printCities(x, id){
        let ispis=`<option value="0">Select your city</option>`
        for(let e of x){
            ispis+=`<option value="${e.id}">${e.name}</option>`
        }
        $(id).html(ispis)
    } 
    let greskaTA = false
    let objTA = document.getElementById("ta")
    let brojSlova = document.getElementById("slova").textContent
    let brojObj = document.getElementById("slova")
    let broj = Number(brojSlova)
    let konacno = 0
    let brojac = 20  
    objTA.addEventListener("keydown", function(){    
        let taValue = document.getElementById("ta").value.length
        let taNum = Number(taValue)
        if(taNum==0){taNum+=1}
        konacno = brojac - (taNum)
        brojObj.innerHTML=konacno
        if(taValue>20){
            brojObj.innerHTML=0
            greskaTA = true
            objTA.parentElement.parentElement.classList.add("okvirTA")
        }
        else{
            objTA.parentElement.parentElement.classList.remove("okvirTA")
            greskaTA = false
        }
    })
    function obradaForme(){       
        //elementi forme koji se proveravaju
        let objImePrezime = document.getElementById("text1");
        let objMail = document.getElementById("text2");
        let objRadio = document.getElementsByName("rbtn");
        let objTel = document.getElementById("text3");
        let objAdresa = document.getElementById("text5")
        //regularni izrazi za sve elemente forme
        let regIzrazImePrezime = /^[A-ZŠĐŽČĆ][a-zšđčćž]{2,19}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,19}){1,3}$/;
        let regBrojTelefona = /^(\+381|0)(6[0-9])([0-9]{6,8})$/;                 
        let regAdresa = /^[A-Z][a-z]+(\s[A-Z][a-z]+)*(\s[a-z]+)*(\s\d+[A-Za-z]?)?$/;
        let greskaImePrez = false;
        let greskaBroj = false;
        let greskaRadio = false;
        let greskaSelect = false;
        let greskaMejl = false;
        let greskaAdresa = false;   
        
            if(!regIzrazImePrezime.test(objImePrezime.value)){
                objImePrezime.nextElementSibling.classList.add("display-block");
                objImePrezime.nextElementSibling.innerHTML = "The first and last name must start with a capital letter and contain at least three characters, example:<br/>Aleksandar Kandic";
                objImePrezime.classList.add("okvir-greska");
                greskaImePrez=true;
            }
            else{
                objImePrezime.nextElementSibling.classList.remove("display-block");
                objImePrezime.nextElementSibling.innerHTML = "";
                objImePrezime.classList.remove("okvir-greska");
                greskaImePrez=false;
            }
            //provera broja telefona
            if(!regBrojTelefona.test(objTel.value)){
                objTel.nextElementSibling.classList.add("display-block");
                objTel.nextElementSibling.innerHTML = "The phone number must be in the format::<br/> +381658255131 or 0658255131";
                objTel.classList.add("okvir-greska");
                greskaBroj=true;
            }
            else{
                objTel.nextElementSibling.classList.remove("display-block");
                objTel.nextElementSibling.innerHTML = "";
                objTel.classList.remove("okvir-greska");
                greskaBroj=false;
            }
            //prevera adrese
            if(!regAdresa.test(objAdresa.value)){
                objAdresa.nextElementSibling.classList.add("display-block");
                objAdresa.nextElementSibling.innerHTML = "The address must be in the format:<br/>Oxford Street 32B";
                objAdresa.classList.add("okvir-greska");
                greskaAdresa=true;
            }
            else{
                objAdresa.nextElementSibling.classList.remove("display-block");
                objAdresa.nextElementSibling.innerHTML = "";
                objAdresa.classList.remove("okvir-greska");
                greskaAdresa=false;
            }
            //provera mejla
            if(!regMail.test(objMail.value)){
                objMail.nextElementSibling.classList.add("display-block");
                objMail.nextElementSibling.innerHTML = "Email must be in the format: user@gmail.com";
                objMail.classList.add("okvir-greska");
                greskaMejl=true;
            }
            else{
                objMail.nextElementSibling.classList.remove("display-block");
                objMail.nextElementSibling.innerHTML = "";
                objMail.classList.remove("okvir-greska");
                greskaMejl=false;
            }
            //radio kupljenje vrednosti
            let radioValue = "";
            for(let i=0;i<objRadio.length;i++){
                if(objRadio[i].checked){
                    radioValue = objRadio[i].value;
                    break;
                }
            }
            //provera radio buttona
            if(radioValue == ""){
                objRadio[0].parentElement.nextElementSibling.classList.add("display-block");
                objRadio[0].parentElement.classList.add("okvir");
                objRadio[0].parentElement.nextElementSibling.innerHTML = "Select a status"
                greskaRadio = true;
            }
            else{
                objRadio[0].parentElement.nextElementSibling.classList.remove("display-block");
                objRadio[0].parentElement.nextElementSibling.innerHTML = "";
                objRadio[0].parentElement.classList.remove("okvir");
                greskaRadio=false;
            }
            //console.log(radioValue)
            if(!greskaImePrez && !greskaBroj && !greskaMejl && !greskaSelect && !greskaRadio && !greskaTA &&    !greskaAdresa){
                let brojSlova = document.getElementById("slova")
                brojSlova.innerHTML=20
               
                let modal = document.getElementById("modalKontakt")
                modal.classList.add("block")
                $("#ispis").html("You have successfully sent a message, one of the employees will contact you soon")
                let buttonCloseModal2 = document.getElementById("closeModal2")
                buttonCloseModal2.addEventListener("click",function(){
                    modal.classList.remove("block");
                });

                
                $.ajax({
                    url:"logic/kontakt.php",
                    method:"post",
                    type:"json",
                    data:{
                        imePrezime : objImePrezime.value,
                        mail : objMail.value,
                        adresa : objAdresa.value,
                        telefon : objTel.value,
                        tip : radioValue,
                        poruka : objTA.value
                       
                    },
                    success:function(x){
                        console.log(x)
                    },
                    error:function(){

                    }
                })

                document.getElementById("formaNova").reset();
            }
            
        }
}







if(url.indexOf("author.php")!=-1 || url=="/author.php"){
    console.log("aa")
    window.onload = function(){
        let listaObj = document.getElementById("mrz")
        let nizMreza = ["instagram mreze","facebook-box mreze ml-3","twitter-box mreze ml-3","linkedin mreze ml-3"]
        let ispis = ""
        for(let x of nizMreza){
            ispis+=`<li><a href="#"><i class="zmdi zmdi-${x}"></i></a></li>`
        }
        listaObj.innerHTML=ispis
    } 
}
let regMail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
let mailobj = document.getElementById("email");

//if(url != "?page=admin"){
    let buttonCloseModal3 = document.getElementById("closeModal3");
    let modalCart2 = document.getElementById("modalMail");
    let upis = document.getElementById("suc")
    buttonCloseModal3.addEventListener("click",function(){
    modalCart2.classList.remove("block");
    $("#suc").removeClass("err");
});
//}
$("#su").click(function(){
    if(regMail.test(mailobj.value)){
        modalCart2.classList.add("block")
        upis.innerHTML="You have successfully subscribe to the Handbags Store mailing list"
        
        $.ajax({
            url:"models/newsletter.php",
            method:"POST",
            type:"json",
            data:{
                    mejl : mailobj.value
                },
            success:function(x){
                console.log(x)
            },
            error:function(x){
                console.log(x);
            }
        
       })
    }
    else{
        $("#suc").addClass("err");
        modalCart2.classList.add("block")
        upis.innerHTML="You made a mistake when entering your email address, the address must be in the following format: user@gmail.com"
    }
})
function cartEmpty(){
    return modalContent.innerHTML = `<p id="em">Your cart is empty</p>`
}
function showProducts(){
    let products = getFromLocalStorage("cart");
    let modalContent = document.getElementById("modalContent")
    if(products==null){
        $("#total").html("0 &euro;")
        return cartEmpty()      
    }
    else{
        ispis=""
        let allProduct = getFromLocalStorage("artikli")
        let filtrirani=[]
        allProduct = JSON.parse(allProduct)

        console.log(allProduct)
        for(let pa of allProduct){
            for(let pc of products){
                if(pa.id_proizvod ==pc.id){
                    filtrirani.push(pa)
                }
            }
        }
        function quantity(id){
            for(let p of products){
                if(p.id == id){
                    return p.quantity
                }
            }
        }
        let suma=0
        for(p of filtrirani){
            ispis+=`<div class="kup">
                        <div class="cartSlika">
                            <img src="assets/images/product-images/thumbnail/${p.slika}"/>
                        </div>
                        <p class="naziv">${p.naziv}</p>
                        <div>
                            <p>
                                Price per piece: ${p.cena} &euro;
                            </p><br/>
                            <p>
                                Total price for quantity: ${p.cena * quantity(p.id_proizvod)} &euro;
                            </p>
                        </div>

                        <div class="brojac">
                            <button class="minus kol" data-id="${p.id_proizvod}">-</button>
                            <div class="broj">${quantity(p.id_proizvod)}</div>
                            <button class="pluss kol" data-id="${p.id_proizvod}">+</button>
                        </div>

                        <button class="obrisi" data-id="${p.id_proizvod}">
                            Remove item 
                        </button>
                       
                    </div>`
                    suma +=p.cena * quantity(p.id_proizvod)
                    $("#total").html(suma+" &euro;")
                    
                    
        }
             
        modalContent.innerHTML = ispis     
        let buttonsObrisi = document.getElementsByClassName('obrisi');
        let obrisi = Array.from(buttonsObrisi)
        obrisi.forEach(function(button) {
        button.addEventListener('click', removeItemFromCart);
        });
        let buttonsPlus = document.getElementsByClassName('pluss');
        let niz1 = Array.from(buttonsPlus)
        niz1.forEach(function(button) {
        button.addEventListener('click', plus);
        });
        let buttonsMinus = document.getElementsByClassName('minus');
        let niz2 = Array.from(buttonsMinus)
        niz2.forEach(function(button) {
        button.addEventListener('click', minus);
        });   
    }
    function removeItemFromCart(){
        let id = $(this).data("id")
        let svi = getFromLocalStorage("cart")
        let fil = svi.filter(x=> x.id != id)
        saveToLocalStorage("cart",fil)
        $("#broj").html(fil.length)
        if(fil.length==0){
            $("#total").html("0 &euro;")
            localStorage.removeItem("cart")
            return cartEmpty()
        }
         showProducts()
    }
    function plus(){
        let id = $(this).data("id")
        let svi = getFromLocalStorage("cart")
        let fil = svi.filter(x=>x.id == id)
        fil[0] = {
            id:id,
            quantity: fil[0].quantity++
        }
        saveToLocalStorage("cart", svi)
        showProducts()
    }
    function minus(){
        let id = $(this).data("id")
        let svi = getFromLocalStorage("cart")
        let fil = svi.filter(x=>x.id == id)         
        if(fil[0].quantity>1){
            fil[0] = {
                id:id,
                quantity: fil[0].quantity--
            }
        }
        if(fil[0].quantity<2){
            let fil2 = svi.filter(x=>x.id != id)
            saveToLocalStorage("cart", fil2)
             showProducts()
            if(fil2.length==0){
                $("#total").html("0 &euro;")
                localStorage.removeItem("cart")
                cartEmpty()
            }
            $("#broj").html(fil2.length)
        }
        else{
            saveToLocalStorage("cart", svi)
             showProducts()
        }       
    }
}
setInterval(function(){
    if(getFromLocalStorage("cart")!=null){
        $("#preusmeri").addClass("block")
    }else{
        $("#preusmeri").removeClass("block")
    }
},100)
setInterval(function(){
    if(getFromLocalStorage("cart")!=null){
        $("#obrisi").addClass("block")
    }else{
        $("#obrisi").removeClass("block")
    }
},100)


$("#obrisi").click(function(){
    localStorage.removeItem("cart")
     showProducts()
    $("#total").html("0 &euro;")
    $("#broj").html("0")
})
function addToCart(){
    let prouctId = $(this).data("id");
    let cart = getFromLocalStorage("cart");

    if(cart == null){
        firstItem();
        numberOfProducts();
    }
    else{
        if(productIsInCart()){
            update();
        }
        else{
            addItemToCart();
            numberOfProducts();
        }
    }
    function firstItem(){
        let products = [
            {
                id: prouctId,
                quantity: 1
            }
        ];

        saveToLocalStorage("cart", products);
    }
    function productIsInCart(){
        return cart.filter(el => el.id == prouctId).length;
    }
    function update(){
        let productsLS = getFromLocalStorage("cart");

        for(let p of productsLS){
            if(p.id == prouctId){
                p.quantity++;
                break;
            }
        }
        saveToLocalStorage("cart", productsLS);
    }
    function addItemToCart(){
        let productLS = getFromLocalStorage("cart");
        productLS.push({
            id: prouctId,
            quantity: 1
        });
        saveToLocalStorage("cart", productLS);
    }
}
function numberOfProducts(){
    let productsCart = getFromLocalStorage("cart");
    console.log(productsCart)
    if(productsCart == null){
        $("#broj").html(`0`);
    }
    else{
        let numberOfProducts = productsCart.length;
        $("#broj").html(`${numberOfProducts}`)
        console.log(numberOfProducts)
    }
}
var dodato = document.getElementById("dodato");
function addToCartAnimation() {
    dodato.classList.add("block");
    setTimeout(function() {
        dodato.classList.remove("block");
    }, 1000);
}
let buttonCloseModalError = document.getElementById("closeModal4");
let modalError = document.getElementById("modalError");

if(url.indexOf("admin")==-1){
    buttonCloseModalError.addEventListener("click", function(){
        modalError.classList.remove("block")
    })
}

if(url.indexOf("register")!=-1 || url=="?page=register"){

    $("#registruj").click(function(){

        let objIme = document.getElementById("ime");
        let objPrezime = document.getElementById("prezime");
        let objMail = document.getElementById("mail");
        let objPass = document.getElementById("pass");
        let objRePass = document.getElementById("pass2");

        
        let regIzrazIme = /^[A-Z][a-z]{2,19}$/;                
        let regMail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        let greskaIme = false;
        let greskaPrezime = false;
        let greskaMejl = false;
        let greskaPass = false;   
        let greskaPass2 = false;  


       
       
            //provera imena i prezimena
            if(!regIzrazIme.test(objIme.value)){
                objIme.nextElementSibling.classList.add("display-block");
                objIme.classList.add("okvir-greska");
                objIme.nextElementSibling.innerHTML = "The first and last name must start with a capital letter and contain at least three characters, example:<br/>Aleksandar";
                greskaIme=true;
            }
            else{
                objIme.nextElementSibling.classList.remove("display-block");
                objIme.classList.remove("okvir-greska");
                objIme.nextElementSibling.innerHTML = "";
                greskaIme=false;
            }
            
            if(!regIzrazIme.test(objPrezime.value)){
                objPrezime.nextElementSibling.classList.add("display-block");
                objPrezime.classList.add("okvir-greska");
                objPrezime.nextElementSibling.innerHTML = "The first and last name must start with a capital letter and contain at least three characters, example:<br/>Kandic";
                greskaPrezime=true;
            }
            else{
                objPrezime.nextElementSibling.classList.remove("display-block");
                objPrezime.classList.remove("okvir-greska");
                objPrezime.nextElementSibling.innerHTML = "";
                greskaPrezime=false;
            }
            
            if(!regMail.test(objMail.value)){
                objMail.nextElementSibling.classList.add("display-block");
                objMail.nextElementSibling.innerHTML = "Email must be in the format: user@gmail.com";
                objMail.classList.add("okvir-greska");
                greskaMejl=true;
            }
            else{
                objMail.nextElementSibling.classList.remove("display-block");
                objMail.nextElementSibling.innerHTML = "";
                objMail.classList.remove("okvir-greska");
                greskaMejl=false;
            }

            if(objPass.value.length<8){
                objPass.nextElementSibling.classList.add("display-block");
                objPass.nextElementSibling.innerHTML = "The password must contain at least 8 characters";
                objPass.classList.add("okvir-greska");
                greskaPass=true;
            }
            else{
                objPass.nextElementSibling.classList.remove("display-block");
                objPass.nextElementSibling.innerHTML = "";
                objPass.classList.remove("okvir-greska");
                greskaPass=false;
            }

            if(objPass.value != objRePass.value){
                objRePass.nextElementSibling.classList.add("display-block");
                objRePass.nextElementSibling.innerHTML = "Passwords do not match";
                objRePass.classList.add("okvir-greska");
                greskaPass2=true;
            }
            else{
                objRePass.nextElementSibling.classList.remove("display-block");
                objRePass.nextElementSibling.innerHTML = "";
                objRePass.classList.remove("okvir-greska");
                greskaPass2=false;
            }
           
            if(!greskaIme && !greskaPrezime && !greskaMejl && !greskaPass && !greskaPass2){
               
                
                

                let imee = objIme.value
                let prezimee = objPrezime.value
                let maill = objMail.value
                let passwordd = objPass.value
                let passwordd2 = objRePass.value

            
                console.log(imee)
                 $.ajax({
                    url:"models/registracija.php",
                    method:"POST",
                    type:"json",
                    data:{
                            ime:imee,
                            prezime:prezimee,
                            mail:maill,
                            password:passwordd,
                            password2:passwordd2
                        },
                    success:function(x){
                        $("#prijava").html(x)
                        $("#prijava").addClass("display-block")
                    },
                    error:function(x){
                        console.log(x);
                    }
                
               })
              
               document.getElementById("formaRegister").reset();
            }
            else{
                $("#prijava").html('')
                $("#prijava").removeClass("display-block")
            }
        
    })
}

if(url.indexOf("login")!=-1 || url=="?page=login"){

    $("#signin").click(function(){

        
        let objMail = document.getElementById("mail");
        let objPass = document.getElementById("password");
             
        let regMail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        let greskaMejl = false;
        let greskaPass = false;   

            
            if(!regMail.test(objMail.value)){
                objMail.nextElementSibling.classList.add("display-block");
                objMail.nextElementSibling.innerHTML = "Email must be in the format: user@gmail.com";
                objMail.classList.add("okvir-greska");
                greskaMejl=true;
            }
            else{
                objMail.nextElementSibling.classList.remove("display-block");
                objMail.nextElementSibling.innerHTML = "";
                objMail.classList.remove("okvir-greska");
                greskaMejl=false;
            }

            if(objPass.value.length<8){
                objPass.nextElementSibling.classList.add("display-block");
                objPass.nextElementSibling.innerHTML = "The password must contain at least 8 characters";
                objPass.classList.add("okvir-greska");
                greskaPass=true;
            }
            else{
                objPass.nextElementSibling.classList.remove("display-block");
                objPass.nextElementSibling.innerHTML = "";
                objPass.classList.remove("okvir-greska");
                greskaPass=false;
            }

           
            if(!greskaMejl && !greskaPass){
               
                let maill = objMail.value
                let passwordd = objPass.value

                
               $.ajax({
                url:"models/logovanje.php",
                method:"POST",
                type:"json",
                data:{
                        mail:maill,
                        password:passwordd,
                    },
                success:function(x){
                    if(x=="redirect"){
                        window.location.href = "index.php?page=shop";
                    }
                    else{
                        $("#prijava").html(x)
                        $("#prijava").addClass("display-block")
                    }
                    
                },
                error:function(x){
                    console.log(x);
                }
                
               })
              
               //document.getElementById("formaRegister").reset();
            }
            else{
                $("#prijava").html('')
                $("#prijava").removeClass("display-block")
            }
        
    })
}
if(url.indexOf("survay")!=-1 || url=="?page=survey"){
    $(".ank").change(function(){
        let idAnkete = $("#skriven").val()
        let izabran = $(".ank:checked").val()
        $.ajax({
            url:"models/anketaOdgovor.php",
            method:"POST",
            type:"json",
            data:{
                    odgovor:izabran,
                    id:idAnkete
                },
            success:function(x){
                let modal = document.getElementById("modalKontakt")
                modal.classList.add("block")
                $("#ispis").html(x)
                let buttonCloseModal2 = document.getElementById("closeModal2")
                buttonCloseModal2.addEventListener("click",function(){
                    modal.classList.remove("block");
                });
                
            },
            error:function(x){
                console.log(x);
            }
            
           })
    })
}

$("#preusmeri").click(function(event){
    event.stopPropagation()
    let porudzbina = JSON.stringify(getFromLocalStorage("cart"))
    $.ajax({
        url:"models/narudzbina.php",
        method:"POST",
        type:"JSON",
        data:{
                porudzbina : porudzbina
            },
        success:function(result){
            let modal = document.getElementById("modalKontakt")
            modal.classList.add("block")
            $("#ispis").html(result)
            let buttonCloseModal2 = document.getElementById("closeModal2")
            buttonCloseModal2.addEventListener("click",function(){
                modal.classList.remove("block");
                localStorage.removeItem("cart")
                showProducts()
                $("#broj").html("0")
            });
        },
        error:function(x){
            let modal = document.getElementById("modalKontakt")
            modal.classList.add("block")
            $("#ispis").html(x)
            let buttonCloseModal2 = document.getElementById("closeModal2")
            buttonCloseModal2.addEventListener("click",function(){
                modal.classList.remove("block");
            });
        }
    
   })
})