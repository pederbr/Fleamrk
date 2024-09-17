<?php
    include("top_navbar.php");
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <title>Om oss</title>
    <style>
        #fancy_text {
            display: flex;
            flex-wrap: wrap;
            margin: 10px;
        }

        #fancy_text p {
            font-size: 1.2rem;
        }

        #fancy_text img {
            width: 30%;
        }
        #width_65 { width: 65%;}
        h2 {width: 100%;}

        @media screen and (max-width: 500px) { 
            
        #fancy_text {
            text-align: center;
        }


        #fancy_text p { 
            font-size: 1rem;
        }

        #width_65 {
            width: 100%;   
        }

        #fancy_text img {
            width: 100%;
        }

        }
    </style>
</head>

<body>
    <main>
        <article>
            <div class="margin">
                <h1>Om oss</h1>
            </div>
            <div id="fancy_text">
                <div id="width_65">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates quos ullam, sapiente at
                        culpa
                        voluptate rem est nihil nam, ut perferendis iste dolorum, quae nostrum neque quo suscipit cumque
                        corporis. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint, labore dolor! Quod
                        sed,
                        quasi deserunt quam, incidunt sunt unde ad magni quibusdam eius soluta obcaecati suscipit
                        dolorem
                        veritatis sint eaque! Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quam neque
                        repudiandae nostrum vitae aliquid reprehenderit maiores iusto et, nesciunt at odit mollitia quod
                        corporis deserunt aspernatur quo necessitatibus deleniti. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Eius nam repudiandae totam inventore recusandae, ab corrupti laudantium fuga
                        minus similique facere veniam? Beatae mollitia minus perferendis aspernatur dignissimos, eos
                        accusamus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti aliquid cumque
                        ipsam culpa necessitatibus possimus similique, sit aliquam eum itaque commodi recusandae ducimus
                        inventore consequuntur quasi laudantium error! Inventore, sit.</p>
                </div>
                <img src="website_pictures\fleamrk_L.png" alt="logo">
                <br>
                <h2>Lorem Ipsum</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis laboriosam possimus quis blanditiis
                    unde eum ad quisquam, rem rerum nostrum voluptas veritatis consequuntur libero error cupiditate!
                    Sapiente quibusdam vitae architecto? Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus
                    voluptas alias vel explicabo sint iste iure deserunt beatae odit impedit, temporibus dolorum
                    nesciunt quam voluptate inventore rem itaque architecto possimus! Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Voluptatibus doloribus, dicta iste hic accusamus, quis, vel minus
                    eveniet porro architecto corrupti voluptas deserunt similique totam quam quo quos? Nemo,
                    consectetur!</p>
            </div>
        </article>
    </main>
    <?php include("footer.html")?>

</body>

</html>