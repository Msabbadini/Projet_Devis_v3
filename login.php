<?php
session_start();
if(isset($_SESSION['connect'])){
    header('location:index.php');
};
include('./src/Php/entete.php');
?>
 <div class="w-full flex flex-wrap">

<!-- Login Section -->
<div class="w-full md:w-1/2 flex flex-col">

    <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
        <div  class=" text-white font-bold text-xl p-4"><img src="src/assets/logo-lionel.png" alt="logo lionel thibaud " class="w-28  ">
    </div>
    </div>

    <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
        <p class="text-center text-3xl">Bienvenue.</p>
        <span id='validLogin' class='text-lg text-green-600 text-center'></span>
        <span id='errorLogin' class='text-lg text-red-600 text-center'></span>
        <form class="flex flex-col pt-3 md:pt-8">
            <div class="flex flex-col pt-4">
                <label for="email" class="text-lg">Email/Pseudo</label>
                <span id='logError' class=' text-lg text-red-700'></span>
                <input type="text" id="email" name='pseudo' :w
                placeholder="Email/Pseudo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex flex-col pt-4">
                <label for="password" class="text-lg">Mot de passe</label>
                <span id='mpError' class=' text-lg text-red-700'></span>
                <input type="password" id="password" placeholder="Votre mot de passe" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
            </div>

        </form>
        <button  id='but_login' class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Connexion</button>
    </div>

</div>

<!-- Image Section -->
<div class="w-1/2 shadow-2xl">
    <img class="object-cover w-full h-screen hidden md:block" src="src/assets/charpente_2.5.jpg">
</div>
</div>
<script  src="src/Js/ajax.login.js"></script>

<?php include('src/Php/pied_page.php')?>