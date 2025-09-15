<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajador = new Trabajador();
        $trabajador->user_id = '1';
        $trabajador->description = 'En Belmonte Muebles nos especializamos en la fabricación de todo tipo de muebles y cocinas a medida en la ciudad de Cochabamba. Ofrecemos soluciones completas para el amoblado de casas y departamentos, cuidando cada detalle en diseño, resistencia y acabado.
        Trabajamos principalmente con melamina de máxima calidad, lo que nos permite entregar muebles modernos, duraderos y funcionales. Desde cocinas integrales hasta closets, dormitorios, salas y oficinas, adaptamos cada proyecto al estilo y necesidades de nuestros clientes.
        Nos destacamos por la puntualidad, seriedad y personalización en cada encargo. Aceptamos todo tipo de proyectos, ya sea pequeños trabajos o el equipamiento completo de un hogar.';
        $trabajador->workshop = 'Belmonte Muebles';
        $trabajador->latitud = '-17.373592';
        $trabajador->longitud = '-66.157783';
        $trabajador->address = 'Calle buenos aires y trinidad';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp1_1.png", 
            "image2" => "imagesTrabajador/carp1_2.jpg",
            "image3" => "imagesTrabajador/carp1_3.jpg",
            "image4" => "imagesTrabajador/carp1_4.jpg",
            "image5" => "imagesTrabajador/carp1_5.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '2';
        $trabajador->description = 'En Carpintería Vico, ubicada en la Av. Costanera #450, encontrarás un taller independiente dedicado a la fabricación de muebles en general, adaptados al estilo y las necesidades de cada cliente.

Además de diseñar y construir muebles para el hogar y la oficina, ofrecemos servicio de mantenimiento y reparación, prolongando la vida útil de tus muebles y devolviéndoles su buen estado.

Con años de experiencia en el oficio, Vico se caracteriza por su trabajo detallado, compromiso y trato directo, garantizando soluciones prácticas y de calidad para todo tipo de espacios.';
        $trabajador->workshop = 'Carpinteria Vico';
        $trabajador->latitud = '-17.390810';
        $trabajador->longitud = '-66.165045';
        $trabajador->address = 'Av Costanera #450';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp2_1.jpg",
            "image2" => "imagesTrabajador/carp2_2.jpg",
            "image3" => "imagesTrabajador/carp2_3.jpg",
            "image4" => "imagesTrabajador/carp2_4.jpg",
            "image5" => "imagesTrabajador/carp2_5.jpg",

        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '3';
        $trabajador->description = 'Cristóbal Ibarra, artesano carpintero en Cochabamba, es el fundador de la Carpintería Ibarra, un taller pequeño pero con gran dedicación al arte de la madera.

Se especializa en la fabricación de todo tipo de muebles, con un enfoque especial en mesas y taburetes, productos que destacan por su resistencia, funcionalidad y acabado artesanal. Además, no solo los fabrica a medida, sino que también los pone a la venta para quienes buscan piezas listas para su hogar o negocio.

Con un estilo auténtico y un trabajo hecho con pasión, Carpintería Ibarra combina tradición y creatividad en cada proyecto.';
        $trabajador->workshop = 'Carpintería Ibarra';
        $trabajador->latitud = '-17.388950';
        $trabajador->longitud = '-66.085382';
        $trabajador->address = 'Km 5 1/2 hacia sacaba';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp3_1.jpg",
            "image2" => "imagesTrabajador/carp3_2.jpg",
            "image3" => "imagesTrabajador/carp3_2.jpg",
            "image4" => "imagesTrabajador/carp3_4.jpg",
            "image5" => "imagesTrabajador/carp3_5.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '4';
        $trabajador->description = 'La Carpintería J&V, ubicada en el km 5 hacia Sacaba, es un taller independiente que ofrece servicios especializados en revestimientos, zócalos, pisos entablonados, gradas, marcos, puertas y carpintería en general.

Nos destacamos por brindar asesoría personalizada, consultas y cotizaciones sin compromiso, asegurando que cada proyecto se ajuste a las necesidades y presupuesto de nuestros clientes.

Con experiencia y dedicación, J&V transforma los espacios con acabados de calidad y un trabajo hecho con precisión artesanal.';
        $trabajador->workshop = 'Carpinteria J&V';
        $trabajador->latitud = '-17.386538';
        $trabajador->longitud = '-66.095800';
        $trabajador->address = 'Av. Villazon km 5';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp4_1.jpg",
            "image2" => "imagesTrabajador/carp4_2.jpg",
            "image3" => "imagesTrabajador/carp4_3.jpg",
            "image4" => "imagesTrabajador/carp4_4.jpg",
            "image5" => "imagesTrabajador/carp4_5.jpg",
        ]);
        $trabajador->save();
    
        $trabajador = new Trabajador();
        $trabajador->user_id = '5';
        $trabajador->description = 'Soy Saturnino Chávez, carpintero independiente y dueño de Mueblería Chávez en Cochabamba. Me dedico a fabricar muebles a medida, desde cocinas, roperos empotrados y muebles de oficina hasta muebles de baño, peinadores y mobiliario para farmacias.

Mi objetivo es que cada cliente reciba un trabajo personalizado, funcional y duradero, hecho con dedicación y cuidado en cada detalle.

✨ “En Mueblería Chávez transformo tus ideas en muebles a medida.”';
        $trabajador->workshop = 'Muebleria Chavez';
        $trabajador->latitud = '-17.354421';
        $trabajador->longitud = '-66.152492';
        $trabajador->address = 'Calle agustin guzman 2da circunvalacion';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp5_1.jpg",
            "image2" => "imagesTrabajador/carp5_2.jpg",
            "image3" => "imagesTrabajador/carp5_3.jpg",
            "image4" => "imagesTrabajador/carp5_4.jpg",
            "image5" => "imagesTrabajador/carp5_5.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '6';
        $trabajador->description = 'Soy un artesano tallador en madera y mi pasión es dar forma a la madera a través de esculturas y diseños personalizados. Trabajo principalmente en estilos clásicos, con molduras y detalles finos que resaltan la belleza natural de la madera.

Cada pieza es única y elaborada a pedido, combinando tradición, arte y dedicación.';
        $trabajador->workshop = 'Tallador en Madera';
        $trabajador->latitud = '-17.354421';
        $trabajador->longitud = '-66.152492';
        $trabajador->address = 'Cochabamba-cercado';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp6_1.jpg",
            "image2" => "imagesTrabajador/carp6_2.jpg",
            "image3" => "imagesTrabajador/carp6_3.jpg",
            "image4" => "imagesTrabajador/carp6_4.jpg",
        ]);
        $trabajador->save();

        


        $trabajador = new Trabajador();
        $trabajador->user_id = '7';
        $trabajador->description = 'Me conocen como BarnizFlash. No hablo mucho de mí, prefiero que mi trabajo hable por sí solo. Mi especialidad es el barnizado y rebarnizado de muebles de madera, así como de puertas, portones, marcos y detalles en madera.

Trabajo con dedicación para devolver el brillo, la protección y la elegancia a cada pieza, cuidando que luzca como nueva.';
        $trabajador->workshop = 'Barnizador profesional';
        $trabajador->latitud = '-17.393703';
        $trabajador->longitud = '-66.230856';
        $trabajador->address = 'Av Victor Ustariz y 16 de julio';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp7_1.jpg",
            "image2" => "imagesTrabajador/carp7_2.jpg",
            "image3" => "imagesTrabajador/carp7_3.jpg",
            "image4" => "imagesTrabajador/carp7_4.jpg",
            "image5" => "imagesTrabajador/carp7_5.jpg",
        ]);
        $trabajador->save();



        $trabajador = new Trabajador();
        $trabajador->user_id = '8';
        $trabajador->description = 'En MYM Mobiliario nos dedicamos a realizar todo tipo de trabajos en carpintería con melamina, ofreciendo diseños modernos, funcionales y adaptados a cada necesidad.

Nuestro objetivo es brindar soluciones prácticas en muebles para el hogar y la oficina, siempre con acabados de calidad y al gusto del cliente.”';
        $trabajador->workshop = 'M&M Mobiliario';
        $trabajador->latitud = '-17.376888';
        $trabajador->longitud = '-66.185348';
        $trabajador->address = 'Zona Sarcobamba';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp8_1.jpg",
            "image2" => "imagesTrabajador/carp8_2.jpg",
            "image3" => "imagesTrabajador/carp8_3.jpg",
            "image4" => "imagesTrabajador/carp8_4.jpg",
            "image5" => "imagesTrabajador/carp8_5.jpg",
        ]);
        $trabajador->save();



        $trabajador = new Trabajador();
        $trabajador->user_id = '9';
        $trabajador->description = 'Ofrecemos instalación, revestimiento y automatización de portones de madera. Trabajamos con materiales de calidad y garantizamos un acabado duradero y estético.

Servicio profesional y confiable, adaptado a las necesidades de tu hogar o negocio.';
        $trabajador->workshop = 'Portones en general';
        $trabajador->latitud = '-17.354421';
        $trabajador->longitud = '-66.152492';
        $trabajador->address = 'Ciudad de cochabamba';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp9_1.png",
            "image2" => "imagesTrabajador/carp9_2.jpg",
            "image3" => "imagesTrabajador/carp9_3.jpg",
            "image4" => "imagesTrabajador/carp9_4.jpg",
            "image5" => "imagesTrabajador/carp9_5.jpg",
        ]);
        $trabajador->save();



        $trabajador = new Trabajador();
        $trabajador->user_id = '10';
        $trabajador->description = 'Carpintero especializado en la fabricación de muebles en general, cuidando todo el proceso desde la estructura en madera hasta el acabado y barnizado final. También trabajo muebles en melamina y realizo cajonería alta y baja para cocinas. Me gusta brindar un asesoramiento personalizado a mis clientes, ayudándoles a elegir los mejores materiales, diseños y acabados para que cada proyecto se adapte a sus necesidades y gustos. Mi objetivo es combinar funcionalidad, estética y calidad en cada trabajo que realizo.';
        $trabajador->workshop = 'Carpintero-Ebanista independiente';
        $trabajador->latitud = '-17.415791';
        $trabajador->longitud = '-66.088600';
        $trabajador->address = 'Zona capilla, quintanilla sud';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/imagePapa1.jpg",
            "image2" => "imagesTrabajador/imagePapa2.jpg",
            "image3" => "imagesTrabajador/imagePapa3.jpg",
            "image4" => "imagesTrabajador/imagePapa4.jpg",
            "image5" => "imagesTrabajador/imagePapa5.jpg",
        ]);
        $trabajador->save();
    }
}
