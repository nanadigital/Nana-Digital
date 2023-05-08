<?php

session_start();

if(!isset($_SESSION["user_userName"])){
    header("Location: signin-signup.php");
  }




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>


        <style>
           
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

:root{
  --header-height: 3rem;


  --first-color: #4ea9ff;
  --first-color-dark: #4460bd;
  --first-color-darken: #412cb6;
  --white-color: #FCF8F8;
  

  --body-font: 'Poppins', sans-serif;
  --big-font-size: 2.5rem;
  --normal-font-size: .938rem;

  --z-fixed: 100;
}

@media screen and (min-width: 768px){
  :root{
    --big-font-size: 5rem;
    --normal-font-size: 1rem;
  }
}


*,::before,::after{
  box-sizing: border-box;
}

body{
  margin: var(--header-height) 0 0 0;
  padding: 0;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  font-weight: 500;
}

h1,p,ul{
  margin: 0;
}

ul{
  padding: 0;
  list-style: none;
}
ul ul{
    display: none;
}
ul li:hover >ul{
    display: block;
}

a{
  text-decoration: none;
}

img{
  max-width: 100%;
  height: auto;
}


.bd-grid{
  max-width: 1024px;
  display: grid;
  grid-template-columns: 100%;
  column-gap: 2rem;
  width: calc(100% - 2rem);
  margin-left: 1rem;
  margin-right: 1rem;
}

.l-header{
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  z-index: var(--z-fixed);
  background-color: var(--first-color);
}


.nav{
  height: var(--header-height);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

@media screen and (max-width: 768px){
  .nav__menu{
    position: fixed;
    top: 0;
    right: -100%;
    width: 70%;
    height: 100%;
    padding: 3.5rem 1.5rem 0;
    background: rgba(255,255,255,.3);
    backdrop-filter: blur(10px);
    transition: .5s;
  }
}

.nav__close{
  position: absolute;
  top: .75rem;
  right: 1rem;
  font-size: 1.5rem;
  cursor: pointer;
}

.nav__item{
  margin-bottom: 2rem;
}

.nav__close, .nav__link, .nav__logo, .nav__toggle{
  color: var(--white-color);
}
.nav__logo{
    width: 100%;
    height: 100%;    
    position: absolute;
    display: grid;
    grid-template-columns: repeat(16, 1fr);
    
}
.nav__link:hover{
  color: var(--first-color-dark);
}

.nav__toggle{
  font-size: 1.5rem;
  cursor: pointer;
}


.show{
  right: 0;
}


.home{
  background-color: var(--first-color);
  overflow: hidden;
}

.home__container{
  height: calc(100vh - var(--header-height));
  grid-template-rows: repeat(2, max-content);
  row-gap: 1.5rem;
}

.home__img{
  position: relative;
  padding-top: 1.5rem;
  justify-self: center;
  width: 302px;
  height: 233px;
}

.home__img img{
  position: absolute;
  top: 0;
  left: 0;
}

.home__data{
  color: var(--white-color);
}

.home__title{
  font-size: var(--big-font-size);
  line-height: 1.3;
  margin-bottom: 1rem;
}

.home__description{
  margin-bottom: 2.5rem;
}




@media screen and (min-width: 768px){
  body{
    margin: 0;
  }
  
  .nav{
    height: calc(var(--header-height) + 1.5rem);
  }

  .nav__toggle, .nav__close{
    display: none;
  }

  .nav__list{
    display: flex;
  }

  .nav__item{
    margin-left: 3rem;
    margin-bottom: 0;
  }

  .home__container{
    height: 100vh;
    grid-template-columns: repeat(2, max-content);
    grid-template-rows:  1fr;
    row-gap: 0;
    align-items: center;
    justify-content: center;
  }
  
  .home__img{
    order: 1;
    width: 375px;
    height: 289px;
  }

  .home__img img{
    width: 375px;
  }
}

@media screen and (min-width: 1024px){
  .bd-grid{
    margin-left: auto;
    margin-right: auto;
  }

  .home__container{
    justify-content: initial;
    column-gap: 4.5rem;
  }

  .home__img{
    width: 700px;
    height: 700px;
  }

  .home__img img{
    width: 604px;
  }
}
        </style>
        

        <title>Nana Digital</title>
    </head>
    <body>
        
        <header class="l-header">
            <nav class="nav bd-grid">
                <div>
                    <a href="home.php" class="nav__logo"><img src="img/logo.png" alt=""></a>
                </div>
                
                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>

                <div class="nav__menu" id="nav-menu">
                    <div class="nav__close" id="nav-close">
                        <i class='bx bx-x'></i>
                    </div>

                    <ul class="nav__list">
                        <li class="nav__item"><a href="home.html" class="nav__link active">Home</a></li>
                        <li class="nav__item"><a href="about.html" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="services.html" class="nav__link">Services</a></li>
                        <li class="nav__item"><a href="team.html" class="nav__link">Team</a></li>
                        <li class="nav__item"><a href="contact.html" class="nav__link">Contact</a></li>
                        <li class="nav__item"><a class="nav__link"><?php echo $_SESSION["user_userName"];?></a>
                            <ul><li class="nav__item"><a  href="logout.php" class="nav__link">Logout</a></ul>
                    </li>
                       
                    </ul>
                </div>
            </nav>
        </header>

        <main class="l-main">
           
            <section class="home" id="home">
                <div class="home__container bd-grid">
                    <div class="home__img">
                      <iframe src='https://my.spline.design/macbookprocopy-bb297f4de1c160f271b33c6609e35095/' frameborder='0' width='100%' height='100%'></iframe>
                        
                    </div>
                    
                    <div class="home__data">
                        <h1 class="home__title">NANA<br> Digital</h1>
                        <p class="home__description">Get Ready For The Next Level</p>                        
                    </div>
                </div>
            </section>
        </main>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

      
        <script>

const navMenu = document.getElementById('nav-menu'),
    toggleMenu = document.getElementById('nav-toggle'),
    closeMenu = document.getElementById('nav-close')


toggleMenu.addEventListener('click', ()=>{
    navMenu.classList.toggle('show')
})


closeMenu.addEventListener('click', ()=>{
    navMenu.classList.remove('show')
})


document.addEventListener('mousemove', move);
function move(e){
    this.querySelectorAll('.move').forEach(layer =>{
        const speed = layer.getAttribute('data-speed')

        const x = (window.innerWidth - e.pageX*speed)/120
        const y = (window.innerHeight - e.pageY*speed)/120

        layer.style.transform = `translateX(${x}px) translateY(${y}px)`
    })
}


gsap.from('.nav__logo, .nav__toggle', {opacity: 0, duration: 1, delay:2, y: 10})
gsap.from('.nav__item', {opacity: 0, duration: 1, delay: 2.1, y: 30, stagger: 0.2,})


gsap.from('.home__title', {opacity: 0, duration: 1, delay:1.6, y: 30})
gsap.from('.home__description', {opacity: 0, duration: 1, delay:1.8, y: 30})
gsap.from('.home__button', {opacity: 0, duration: 1, delay:2.1, y: 30})
gsap.from('.home__img', {opacity: 0, duration: 1, delay:1.3, y: 30})

        </script>
    </body>
</html>