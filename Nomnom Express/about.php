

<body>
    <nav>
        
    </nav>
    <section class= "front">
        <div class="front-container">
            <div class= "column-left">
            <h1>About Us</h1>
                <p>Welcome to NomNom Express, your go-to destination for convenient and delicious food delivery. We pride ourselves on delivering a seamless culinary experience right to your doorstep, ensuring that you never have to compromise on taste or quality, even on your busiest days.


</p>
    
    </section>
    <style>
        *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    nav {
        height: 100px;
        background: #34495E;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0rem calc((100vw -1300px) / 2);
        
    }
   
        
    

    nav a {
        text-decoration: none;
        font-size: 1.3rem;
        color: #9AD0C2;
        padding: 0 1.5rem;

        
    }

    nav a:hover {
        color: #ECF4D6;
    }
    .front {
        background: #ECF4D6;
    }
    .front-container {
        margin-left: 2rem;
        display:grid ;
        grid-template-columns: 1fr 1fr ;
        height:95vh ;
        padding: 3rem calc((100vw -1300px) / 2);
    }

    .column-left {
        display:flex ;
        flex-direction:column ;
        justify-content:center ;
        align-items:flex-start ;
        color:#265073 ;
        padding: 0rem 2rem;
    }

    .column-left h1 {
        margin-bottom: 1rem;
        font-size: 3rem;
    }

    .column-left p {
        margin-bottom: 2rem;
        font-size: 1.5rem;
        line-height: 1.5;
    }


    

    .column-right {
        display:flex;
        justify-content:center;
        align-items: center;
        padding: 0rem 2rem;
        margin-top: 30px;
    }

 
    
    @media screen and (max-width: 768px) {
        .front-container{
            grid-template-columns: 1fr;

        }
    }
        
    </style>
</body>
