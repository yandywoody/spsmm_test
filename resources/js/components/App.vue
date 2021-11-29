<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav" >
                    <router-link to="/location" class="nav-item nav-link btn btn-primary m-2 text-white" >Location</router-link>  
                    <router-link to= "/product" class="nav-item nav-link btn btn-primary m-2 text-white" >Product</router-link> 
                    <router-link to= "/request" class="nav-item nav-link btn btn-primary m-2 text-white" >Request</router-link>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>
<script>export default{}</script>