<?php

namespace Database\Seeders;

use App\Models\Reseña;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReseniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //reseña contrato1 
        $reseña = new Reseña();
        $reseña->contrato_id = '1';
        $reseña->comment = 'Encargué mi cocina a este carpintero y la verdad quedé muy satisfecha con el resultado. Cumplió con todo lo que acordamos en diseño y calidad, los muebles quedaron muy bonitos y bien terminados. Lo único es que la entrega se retrasó algunos días, pero valió la pena porque el trabajo final quedó excelente. En general, lo recomiendo.';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco-carp1-11.jpg",
            "image2" => "imagesReseña/reco-carp1-12.jpg",
            "image3" => "imagesReseña/reco-carp1-13.jpg",
        ]);
        $reseña->save();

        //reseña contrato2
        $reseña = new Reseña();
        $reseña->contrato_id = '2';
        $reseña->comment = 'Mandé a hacer un ropero en melamina, un vestidor y unas mesas. El carpintero cumplió con el pedido en el tiempo acordado y en general estoy conforme con el trabajo. Sin embargo, siento que la calidad de algunos acabados podría ser mejor. De todas formas, para el precio y la atención que recibí, considero que estuvo bien';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco-carp1-22.jpg",
            "image2" => "imagesReseña/reco-carp1-23.jpg",
            "image3" => "imagesReseña/reco-carp1-33.jpg",
        ]);
        $reseña->save();

        //reseña contrato3
        $reseña = new Reseña();
        $reseña->contrato_id = '3';
        $reseña->comment = 'Pedí un ropero de madera y quedé conforme en general. El carpintero trabaja muy rápido y sus precios son bastante accesibles, lo cual me sorprendió. Si bien la calidad de los acabados no es la mejor y el brillo del barniz no me terminó de convencer, el resultado cumple con lo que necesitaba. Por el precio y el tiempo de entrega, sí lo recomiendo';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco_vico1-1.jpg",
            "image2" => "imagesReseña/reco_vico1-2.jpg",
        ]);
        $reseña->save();

        //reseña contrato4
        $reseña = new Reseña();
        $reseña->contrato_id = '4';
        $reseña->comment = 'Encargué una cajonería en madera y el resultado fue exactamente lo que habíamos acordado. Los precios me parecieron muy accesibles y además quiero resaltar la buena educación y el trato amable del carpintero. Estoy muy contenta con el trabajo y lo recomiendo sin dudar';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco_vico2-1.jpg",
            "image2" => "imagesReseña/reco_vico2-2.jpg",
            "image3" => "imagesReseña/reco_vico2-3.jpg",
        ]);
        $reseña->save();

        //reseña contrato5
        $reseña = new Reseña();
        $reseña->contrato_id = '5';
        $reseña->comment = 'Mandé a hacer un mueble en melamina y quedé satisfecho con el trabajo. El carpintero cumplió con lo que se acordó y el precio fue bastante bajo. La calidad no es de lo mejor, pero está acorde al costo, así que me parece justo. En general, lo recomiendo por la relación calidad-precio';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco_vico3-1.jpg",
            "image2" => "imagesReseña/reco_vico3-3.jpg",
        ]);
        $reseña->save();

        //reseña contrato6
        $reseña = new Reseña();
        $reseña->contrato_id = '6';
        $reseña->comment = 'Encargué una cajonería de cocina en melamina y en general quedé conforme con el resultado. Al inicio hubo algunos problemas de comunicación y ciertos detalles no salieron exactamente como los habíamos hablado, aunque también fue parte de que no nos entendimos bien. Al final el trabajo quedó bien hecho y cumplió su función, así que estoy satisfecho';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoSaturnido_1.jpg",
        ]);
        $reseña->save();

        //reseña contrato7
        $reseña = new Reseña();
        $reseña->contrato_id = '7';
        $reseña->comment = 'Encargué un marco tallado clásico con mucha moldura. El precio fue bastante alto y la ejecución tardó más de lo esperado, pero el resultado final realmente valió la pena. Ahora que tengo el trabajo en mis manos, puedo decir que la calidad y el detalle superaron mis expectativas. Sin duda, fue un esfuerzo que mereció la espera y el costo';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoTallador1.jpg",
        ]);
        $reseña->save();
        
        //reseña contrato8
        $reseña = new Reseña();
        $reseña->contrato_id = '8';
        $reseña->comment = 'Contraté a este rebarnizador para mi portón de madera y los tablones de mis gradas. El trabajo quedó bien hecho, los acabados son correctos, pero tardó demasiado en terminarlo. Como el trabajo era en sitio y el tiempo era muy importante para mí, no puedo recomendarlo a otros. El resultado es bueno, pero el retraso hizo que la experiencia no fuera satisfactoria';
        $reseña->recommend = false;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/reco_barnizador1.jpg",
            "image2" => "imagesReseña/reco_barnizador2.jpg",
        ]);
        $reseña->save();

        //reseña contrato9
        $reseña = new Reseña();
        $reseña->contrato_id = '9';
        $reseña->comment = 'Encargué una vitrina con una cama escondida en el medio que se despliega, y quedé muy satisfecho con el trabajo del carpintero. Hubo algunas fallas con el cerrajero, pero él supo adecuarse y solucionarlas perfectamente. El trabajo se terminó en el tiempo acordado y ahora todo funciona estupendamente. Estoy realmente contento con el resultado y lo recomiendo';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa1_1.jpg",
            "image2" => "imagesReseña/recoPa1_2.jpg",
            "image3" => "imagesReseña/recoPa1_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato10
        $reseña = new Reseña();
        $reseña->contrato_id = '10';
        $reseña->comment = 'Mis puertas de la calle, el portón y la puerta principal quedaron impresionantes. El carpintero se encargó de todo, incluso del cerrajero, y me entregó todo funcionando y listo para automatizar. El barnizado quedó excelente y se ve muy bonito. Lo recomiendo ampliamente, aunque el precio fue alto';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa2_1.jpg",
            "image2" => "imagesReseña/recoPa2_2.jpg",
            "image3" => "imagesReseña/recoPa2_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato11
        $reseña = new Reseña();
        $reseña->contrato_id = '11';
        $reseña->comment = 'Quería un juego de dormitorio en madera bicolor, con partes en madera natural barnizada y otras en color entero, algo moderno y fuera de lo común. El carpintero cumplió perfectamente con lo que pedí, incluso siendo un trabajo a pedido desde otra ciudad. Quedé muy satisfecho con el resultado y lo recomiendo ampliamente';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa3_1.jpg",
            "image2" => "imagesReseña/recoPa3_2.jpg",
            "image3" => "imagesReseña/recoPa3_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato12
        $reseña = new Reseña();
        $reseña->contrato_id = '12';
        $reseña->comment = 'Encargué unos tablones diagonales para separar espacios en mi sala y quedé muy satisfecho con el resultado. El trabajo quedó impecable, se ve moderno y elegante, y la atención del carpintero fue excelente en todo momento. Sin duda lo recomiendo para quienes buscan un toque distinto en su hogar';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa4_1.jpg",
            "image2" => "imagesReseña/recoPa4_2.jpg",
            "image3" => "imagesReseña/recoPa4_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato13
        $reseña = new Reseña();
        $reseña->contrato_id = '13';
        $reseña->comment = 'Pedí unos escritorios en esquina y quedé muy satisfecho con el resultado. El carpintero me brindó una atención ideal durante todo el proceso y se aseguró de cumplir con lo que necesitaba. Recomiendo su trabajo sin dudarlo';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa5_1.jpg",
            "image2" => "imagesReseña/recoPa5_2.jpg",
            "image3" => "imagesReseña/recoPa5_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato14
        $reseña = new Reseña();
        $reseña->contrato_id = '14';
        $reseña->comment = 'Encargué un pasamanos de madera para mi casa y quedé muy contento con el resultado final. El acabado es excelente y realmente le da un toque elegante a mi hogar. Recomiendo totalmente su trabajo.';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa6_1.jpg",
            "image2" => "imagesReseña/recoPa6_2.jpg",
            "image3" => "imagesReseña/recoPa6_3.jpg",
        ]);
        $reseña->save();

        //reseña contrato15
        $reseña = new Reseña();
        $reseña->contrato_id = '15';
        $reseña->comment = 'Encargué mi cajonería de cocina en melamina bicolor, además del mesón en mármol sintético con instalación del lavaplatos, y quedé totalmente maravillado con el resultado. El trabajo quedó impecable, funcional y con un acabado excelente. Recomiendo su trabajo ampliamente.';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesReseña/recoPa7_1.jpg",
            "image2" => "imagesReseña/recoPa7_2.jpg",
            "image3" => "imagesReseña/recoPa7_3.jpg",
        ]);
        $reseña->save();
    }
}
