<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main_style.css" />
    <title>Om oss</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        #fancy_text {
            display: flex;
            flex-wrap: wrap;
            margin: 20px 0;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #fancy_text p {
            font-size: 1.2rem;
            color: #555;
            margin: 10px 0;
        }

        #fancy_text img {
            width: 30%;
            margin: 10px;
            border-radius: 8px;
        }

        #width_65 {
            width: 65%;
            padding: 10px;
        }

        @media screen and (max-width: 768px) {
            #fancy_text {
                flex-direction: column;
                text-align: center;
            }

            #width_65, #fancy_text img {
                width: 100%;
            }

            #fancy_text img {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
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
                <img src="../styles/website_pictures/fleamrk_L.png" alt="logo">
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
    </div>
</body>

</html>