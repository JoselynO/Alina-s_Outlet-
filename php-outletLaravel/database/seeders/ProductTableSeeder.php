<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();
        DB::table('products')->insert(
            [
                [
                    'id' => 'f1c3f5a4-bebd-4619-b136-ba2bcfbd5c9a',
                    'sex' => 'man',
                    'name' => 'Versace Greca Action Chrono Gold-Tone Bracelet Watch',
                    'description' => 'The Greca Action Chrono is modern watch that embodies Versace essence, equipped with chrono movement and a three-counter dial. A gold-tone bracelet with a butterfly buckle finish this intrepid timepiece.
                     Item:  8343642',
                    'price' => 550,
                    'price_before' => 1280,
                    'stock' => 7,
                    'image' => 'https://goodsdream.com/wp-content/uploads/2023/04/WhatsApp-Image-2023-04-26-at-2.51.35-PM-3.jpeg',
                    'category_id' =>  4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'Versace Greca Action Chrono Two-Tone Bracelet Watch',
                    'description' => '- Quartz movement,
                                      - Water resistant to 50 m,
                                      - Bracelet Strap,
                                      - Face diameter of 45 mm. Item:  8343634',
                    'price' => 629,
                    'price_before' => 1230,
                    'stock' => 4,
                    'image' => 'https://img01.ztat.net/article/spp-media-p1/73cf4d1932cb4f7d8d95b909e827d0bf/ebad4bd716f24ba2ad812f7656885608.jpg?imwidth=1800&filter=packshot',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'Versace Icon Active Mens PU Strap Watch',
                    'description' => 'Iconic and timeless, this Versace Greca Dome watch is an everyday essential piece. This dependable timepiece has a water resistance of up to 50 metres. Item:  5095581',
                    'price' => 399,
                    'price_before' => 700,
                    'stock' => 3,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8612855_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'Versace Medusa Icon Mens Black Leather Strap Watch',
                    'description' => '- Quartz movement, - Water resistant to 50 m, - Strap Strap, - Face diameter of 38 mm. Item:  2452758',
                    'price' => 429,
                    'price_before' => 1100,
                    'stock' => 4,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2452758_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'Gucci Dive Black Dial & Stainless Steel Bracelet Watch',
                    'description' => 'From Gucci Dive collection, this Swiss made timepiece exudes style and functionality. A 38mm stainless steel case boasts a matte black dial with round hour markers. This durable watch is ready for adventure, with water resistancy up to 200 metres. Item:  4964055',
                    'price' => 389,
                    'price_before' => 1000,
                    'stock' => 2,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-4964055_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'TAG Heuer Formula 1 Men Black Dial & Stainless Steel Bracelet Watch',
                    'description' => 'Discover the stunning TAG Heuer Formula 1 Men Stainless Steel Bracelet Watch, from the brand technologically advanced Formula 1 collection. Item:  4797574',
                    'price' => 899,
                    'price_before' => 1800,
                    'stock' => 3,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-4797574_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'man',
                    'name' => 'BOSS Allure Men Yellow Gold-Tone Bracelet Watch',
                    'description' => 'Powered by quartz movement, reliability is a given. A matching gold plated bracelet completes this timepiece, with a water resistance of up to 50m. Item:  3255794',
                    'price' => 149,
                    'price_before' => 399,
                    'stock' => 6,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-3255794_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Gucci G-Frame Yellow Gold-Tone Mesh Bracelet Watch',
                    'description' => 'Gucci G-Frame Yellow Gold-Tone Mesh Bracelet Watch, A chic mesh bracelet completes this timepiece with a fold-over clasp, a sophisticated style statement from Gucci. - Item:  2065789',
                    'price' => 488,
                    'price_before' => 1130,
                    'stock' => 3,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2065789_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Gucci G-Timeless Cat Dial & Two-Tone Bracelet Watch',
                    'description' => 'This Gucci bracelet watch is set to make a style statement. A silver dial features the Gucci feline head within the centre in luxe gold tone,  A two-tone stainless steel and yellow gold-tone bracelet brings this look together. - Item:  4226593',
                    'price' => 629,
                    'price_before' => 1220,
                    'stock' => 5,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-4226593_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Gucci G-Timeless Pink Dial & Two-Tone Bracelet Watch',
                    'description' => '- Item: 	YA1265030',
                    'price' => 710,
                    'price_before' => 1180,
                    'stock' => 4,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2416042_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Versace Stud Icon Diamond Ladies Gold-Tone Bracelet Watch',
                    'description' => '- Item: VE3C00422',
                    'price' => 610,
                    'price_before' => 1230,
                    'stock' => 3,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8343568_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Versace Greca Time Ladies Gold-Tone Bracelet Watch',
                    'description' => '- Item: VE6I00523',
                    'price' => 415,
                    'price_before' => 1020,
                    'stock' => 6,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8612814_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Versace La Greca Ladies Gold-Tone Stainless Steel Bracelet Watch',
                    'description' => '- Item: VE8C00524',
                    'price' => 450,
                    'price_before' => 1300,
                    'stock' => 4,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-9181769_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Longines Mini DolceVita Ladies Diamond & Stainless Steel Bracelet Watch',
                    'description' => 'The Longines Mini Dolcevita watch is afashionable and elegant choice for those seeking timeless luxury. Square-shaped case is crafted from stainless steel is embellished with 38 Top Wesselton IF-VVS diamonds, totalling 0.456 carats. - Item:  8887341',
                    'price' => 1029,
                    'price_before' => 3700,
                    'stock' => 2,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8887341_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Longines DolceVita Ladies 18ct Yellow Gold Green Leather Strap Watch',
                    'description' => 'Introducing the Longines DolceVita watch, a masterpiece of elegance and sophistication. Encased in a stunning 18ct Yellow Gold rectangular case, this timepiece exudes timeless charm. Complementing its luxurious aesthetic is a stylish emerald green alligator leather strap, adding a touch of opulence to its design. - Item:  8670192',
                    'price' => 2400,
                    'price_before' => 4650,
                    'stock' => 3,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8670192_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Emporio Armani Crystal Ladies Rose Gold-Tone Bracelet Watch',
                    'description' => 'The Longines Mini Dolcevita watch is afashionable and elegant choice for those seeking timeless luxury. Square-shaped case is crafted from stainless steel is embellished with 38 Top Wesselton IF-VVS diamonds, totalling 0.456 carats. - Item:  8887341',
                    'price' => 149,
                    'price_before' => 389,
                    'stock' => 5,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2416859_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Versace Greca Logo Mini Ladies Gold-Tone Bracelet Watch',
                    'description' => 'Defined by elegant design and powerful character, meet the Greca Logo bracelet watch from Italian fashion house Versace. Flaunting its label at every opportunity,you may have just met your match. This watch is water resistant up to 30m. - Item:  2452707',
                    'price' => 399,
                    'price_before' => 1050,
                    'stock' => 6,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2452707_0_800.jpg?pristine=true',
                    'category_id' => 4
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Platinum 1ct Diamond Cushion Shape Halo Bridal Set',
                    'description' => 'Nestled at the core of this cushion-shaped cluster ring lies a stunning princess-cut diamond. Enhanced by diamond-set shoulders, this exquisite creation offers an outstanding way to show your love. The total diamond weight of this ring is 1ct. - Item:  8817074',
                    'price' => 2000,
                    'price_before' => 3500,
                    'stock' => 2,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-8817066_0_800.jpg?pristine=true',
                    'category_id' => 5
                ],
                [
                'id' => Str::uuid(),
                'sex' => 'woman',
                'name' => 'Gucci 18ct Yellow Gold Stud Earring',
                'description' => 'Classically Gucci. Add a contemporary edge to any outfit, with these gorgeous GG, logo earrings from Gucci, crafted in 18ct yellow gold. - Model Number: YBD094074002',
                'price' => 299,
                'price_before' => 595,
                'stock' => 3,
                'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-4845595_0_800.jpg?pristine=true',
                'category_id' => 5
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => '18ct Yellow Gold 1ct Diamond Channel Triple Row Ring',
                    'description' => 'This sumptuously crafted 18ct Yellow Gold eternity band is the optimal way to express love to your soulmate.  The total diamond weight for this eternity band is 1ct. - Item:  2474891',
                    'price' => 999,
                    'price_before' => 3000,
                    'stock' => 5,
                    'image' => 'https://www.ernestjones.co.uk/productimages/processed/V-2474778_0_800.jpg?pristine=true',
                    'category_id' => 5
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Teri shoulder bag in signature canvas',
                    'description' => 'Exclusive waterproof canvas and soft leather, Two credit card slots, Interior multifunction pocket, Zip top closure and fabric lining, Detachable handle with a length of 21 cm, Detachable strap with a length of 52.7 cm to carry the bag on the shoulder or crossbody. - Style No. CA548',
                    'price' => 229,
                    'price_before' => 450,
                    'stock' => 5,
                    'image' => 'https://coach.scene7.com/is/image/Coach/ca548_imaa8_a0?$desktopProduct$',
                    'category_id' => 2
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Signature Canvas Mini Rowan Crossbody Bag',
                    'description' => '- Style No. CS183',
                    'price' => 200,
                    'price_before' => 425,
                    'stock' => 5,
                    'image' => 'https://coach.scene7.com/is/image/Coach/cs183_imaa8_a0?$desktopProduct$',
                    'category_id' => 2
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Eliza Top Handle Bag',
                    'description' => '- Style No. CP006',
                    'price' => 299,
                    'price_before' => 595,
                    'stock' => 3,
                    'image' => 'https://coach.scene7.com/is/image/Coach/cp006_imblk_a0?$desktopProduct$',
                    'category_id' => 2
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'woman',
                    'name' => 'Medium Parker Logo Shoulder Bag',
                    'description' => '• N.º de producto # 30F2G7PC6B',
                    'price' => 199,
                    'price_before' => 350,
                    'stock' => 3,
                    'image' => 'https://coach.scene7.com/is/image/Coach/cj617_svvs5_a0?$desktopProduct$',
                    'category_id' => 2
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'unisex',
                    'name' => 'VERSACE',
                    'description' => '- UPC: 8053672947410',
                    'price' => 149,
                    'price_before' => 263,
                    'stock' => 5,
                    'image' => 'https://assets2.sunglasshut.com/cdn-record-files-pi/ecc1aa39-90f6-413a-8138-a8e60146657a/675e816c-7d09-4f93-ba6d-aea701374467/0VE4361__401_87__P21__shad__qt.png',
                    'category_id' => 3
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'unisex',
                    'name' => 'PRADA',
                    'description' => '- UPC: 8056597967495',
                    'price' => 229,
                    'price_before' => 430,
                    'stock' => 10,
                    'image' => 'https://assets2.sunglasshut.com/cdn-record-files-pi/7b62191c-d2ff-4270-be8f-b00b0119fb0b/1e9f7aeb-0d48-4759-b976-b00c0010d7e3/0PR_A51S__1AB5Z1__P21__shad__qt.png',
                    'category_id' => 3
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'unisex',
                    'name' => 'MIU MIU',
                    'description' => '- UPC: 8056597967495',
                    'price' => 199,
                    'price_before' => 350,
                    'stock' => 2,
                    'image' => 'https://assets2.sunglasshut.com/cdn-record-files-pi/1cadfca8-a5ca-41d2-b5ab-b018009bb979/bbeba6f9-54da-43c3-bb2e-b01800fd1cd7/0MU_04ZS__VAU50D__P21__shad__qt.png',
                    'category_id' => 3
                ],
                [
                    'id' => Str::uuid(),
                    'sex' => 'unisex',
                    'name' => 'GUCCI',
                    'description' => '- UPC: 889652394190',
                    'price' => 229,
                    'price_before' => 390,
                    'stock' => 5,
                    'image' => 'https://assets2.sunglasshut.com/cdn-record-files-pi/3430e4fd-1660-4a2d-8cfd-aed601557113/fd631dac-5afd-48d6-9cac-aefa000fc800/0GC001968__2300L1_030A.png',
                    'category_id' => 3
                ],
            ]
        );

    }
}
