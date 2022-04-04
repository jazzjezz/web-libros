        /*DATOS DE LOS LIBROS*/
        let productsJSON = [{
            "name": "2001: una odisea en el espacio",
            "image": "https://m.media-amazon.com/images/I/81vrBR1m8EL._AC_UY218_.jpg",
            "author": "Artur C. Clarke",
            "description" : "Un gran clásico de la ciencia ficción.Los cuatro libros que componen la saga Odisea espacial -2001: Una odisea espacial; 2010: Odisea dos; 2061: Odisea tres; y 3001: Odisea final-suponen uno de los grandes hitos de la literatura de ciencia-ficción y el relato, fantástico pero no fantasioso, de una de las mayores epopeyas de todos los tiempos. La aparición de un misterioso monolito negro es el eje sobre el cual gira una aventura que dura miles de años, desde los primeros pasos del hombre hasta la conquista del espacio, la creación de inteligencias artificiales y el contacto con seres superiores cuya forma de vida nada tiene que ver con la que conocemos en la Tierra.",
            "price": "250.00"
        },
        {
            "name": "Metro 2033",
            "image": "https://m.media-amazon.com/images/I/41fTW7f28PL._AC_UY218_.jpg",
            "author": "Dmitrij Glukhovskij",
            "description":"The year is 2033. The world has been reduced to rubble. Humanity is nearly extinct. The half-destroyed cities have become uninhabitable through radiation. Beyond their boundaries, they say, lie endless burned-out deserts and the remains of splintered forests. Survivors still remember the past greatness of humankind. But the last remains of civilisation have already become a distant memory, the stuff of myth and legend. More than 20 years have passed since the last plane took off from the earth. Rusted railways lead into emptiness. The ether is void and the airwaves echo to a soulless howling where previously the frequencies were full of news from Tokyo, New York, Buenos Aires. Man has handed over stewardship of the earth to new life-forms. Mutated by radiation, they are better adapted to the new world. Man's time is over. A few score thousand survivors live on, not knowing whether they are the only ones left on earth. They live in the Moscow Metro - the biggest air-raid shelter ever built. It is humanity's last refuge. Stations have become mini-statelets, their people uniting around ideas, religions, water-filters - or the simple need to repulse an enemy incursion. It is a world without a tomorrow, with no room for dreams, plans, hopes. Feelings have given way to instinct - the most important of which is survival. Survival at any price. VDNKh is the northernmost inhabited station on its line. It was one of the Metro's best stations and still remains secure. But now a new and terrible threat has appeared. Artyom, a young man living in VDNKh, is given the task of penetrating to the heart of the Metro, to the legendary Polis, to alert everyone to the awful danger and to get help. He holds the future of his native station in his hands, the whole Metro - and maybe the whole of humanity.",
            "price": "300.00"
        },
        {
            "name": "1984",
            "image": "https://m.media-amazon.com/images/I/71NvkZxn-fL._AC_UL320_.jpg",
            "author": "George Orwell",
            "description": "En el año 1984 Londres es una ciudad lúgubre en la que la policía del pensamiento controla de forma asfixiante la vida de los ciudadanos. Winston Smith es un peón de este engranaje perverso, su cometido es reescribir la historia para adaptarla a lo que el partido considera la versión oficial de los hechos hasta que decide replantearse la verdad del sistema que los gobierna y somete.",
            "price": "250.00"
        },
        {
            "name": "La Metamorfosis",
            "image": "https://m.media-amazon.com/images/I/61nlvcmPkGL._AC_UL320_.jpg",
            "author": "Franz Kafka",
            "description" : "En LA METAMORFOSIS Y OTROS RELATOS DE ANIMALES, Franz Kafka (1883-1924) manifiesta la desesperanza respecto a su destino personal y el pesimismo frente a lo humano entendido genéricamente. Para él, el hombre está inmerso en un círculo vicioso: la pérdida de identidad (la animalización del hombre), síntoma de la técnica y la burocratización, produce como reacción, en un movimiento pendular, el abandono a lo instintivo, a lo irracional, a lo visceralmente comunitario (la humanización del animal). Sin embargo, al recurrir a animales, Kafka consigue distanciarse suficientemente de lo narrado como para mostrar el dolor, el aislamiento y la desorientación sin resultar patético. Si las fábulas del racionalismo y la ilustración tomaban a los animales como figuras alegóricas para transmitirnos una enseñanza útil y moral, aquí no se encuentran moralejas. Sin embargo, su ausencia no es el resultado de una búsqueda premeditada de oscuridad por parte del autor, sino la constatación de que el mundo ha tomado un aspecto que ya no nos permite hallarlas.",
            "price": "275.00"
        }];
        /*DIV PRINCIPAL*/
        const books_container = document.querySelector('#books-container');

        /*SE ORDENAN LOS LIRBOS POR NOMBRE*/
        productsJSON.sort((a, b) => {return a.name > b.name});

        /*SE ITERAN LOS LIBROS; SE CREA UN DIV PARA CADA LIBRO; SE AÑADEN LOS EVENTOS*/
        productsJSON.forEach((el) => {
            let product_container = document.createElement('div');
            product_container.className = 'product-container';
            let product_name = document.createElement('h3');            
            product_name.innerText = el.name;
            let product_image = document.createElement('img');
            product_image.src = el.image;
            let product_author = document.createElement('p');
            product_author.className = 'author';
            product_author.innerText = el.author;
            let product_price = document.createElement('p');
            product_price.className = 'price';
            product_price.innerText = '$' + el.price;
            product_container.append(product_name, product_image, product_author, product_price);
            product_container.addEventListener('mouseenter', (event) => {expandProductSize(event.currentTarget);});
            product_container.addEventListener('mouseleave', (event) => {contractProductSize(event.currentTarget);})
            product_container.addEventListener('click', (event) => {showProductInfo(event.currentTarget)})
            books_container.appendChild(product_container);
        });

        /*AGRANDA(TAMAÑO) EL DIV DEL PRODUCTO*/
        function expandProductSize(product){
            let id = setInterval(frame, 500);
            function frame(){
                if (product.matches(':hover')){
                    product.classList.add('grow-book');
                }
                clearInterval(id);
            }
        }

        /*CONTRAE(TAMAÑO) EL DIV DEL PRODUCTO*/
        function contractProductSize(product){
            let id = setInterval(frame, 300);
            function frame(){
                if (!product.matches(':hover')){
                    product.classList.remove('grow-book');
                }
                clearInterval(id);
            }
        }

        function showProductInfo(product){
            books_container.classList.add('hide');
            let bookId = getIdByBook(product.firstChild.innerText);
            let book_title = document.createElement('h2');
            book_title.innerText = productsJSON[bookId].name;
            book_title.classList.add('show');
            let img = document.createElement('img');
            img.src = productsJSON[bookId].image;
            img.classList.add('show');
            let desc = document.createElement('p');
            desc.innerText = productsJSON[bookId].description;
            desc.classList.add('show');
            books_container.parentElement.append(book_title, img, desc);
        }

        function getIdByBook(book_name){
            return productsJSON.findIndex((e) => {return e.name == book_name})
        }