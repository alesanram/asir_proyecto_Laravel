<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Laptop HP Pavilion',
                'description' => 'Laptop de 15.6" con procesador i7, 16GB RAM y 512GB SSD.',
                'stock' => 20,
                'price' => 899.99,
                'category' => 'Laptops',
                'image_url' => 'https://cdn.idealo.com/folder/Product/200527/3/200527384/s11_produktbild_max/hp-pavilion-15-2020.jpg'
            ],
            [
                'name' => 'Laptop Dell Inspiron',
                'description' => 'Laptop de 15.6" con procesador i5, 8GB RAM y 256GB SSD.',
                'stock' => 15,
                'price' => 699.99,
                'category' => 'Laptops',
                'image_url' => 'https://thumb.pccomponentes.com/w-530-530/articles/1086/10861013/133-dell-inspiron-3530-intel-core-i7-1355u-16gb-1tb-ssd-156.jpg'
            ],
            [
                'name' => 'MacBook Air M1',
                'description' => 'Laptop ultraportátil con procesador M1, 8GB RAM y 256GB SSD.',
                'stock' => 30,
                'price' => 999.99,
                'category' => 'Laptops',
                'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MP_144450763?x=320&y=320&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=320&ey=320&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=320&cdy=320'
            ],
            [
                'name' => 'Mouse Logitech',
                'description' => 'Mouse ergonómico inalámbrico con Bluetooth.',
                'stock' => 150,
                'price' => 29.99,
                'category' => 'Periféricos',
                'image_url' => 'https://resource.logitechg.com/w_416,h_312,ar_4:3,c_pad,q_auto,f_auto,dpr_1.0/d_transparent.gif/content/dam/gaming/en/products/g502x-plus/gallery/g502x-plus-gallery-4-black.png'
            ],
            [
                'name' => 'Teclado Mecánico Corsair',
                'description' => 'Teclado mecánico retroiluminado con switches Cherry MX.',
                'stock' => 50,
                'price' => 129.99,
                'category' => 'Periféricos',
                'image_url' => 'https://www.vsgamers.es/thumbnails/product_gallery_medium/uploads/products/corsair/2-TECLADOS/k70-pro-mini-wireless-60/galeria/teclado-mecanico-corsair-k70-pro-mini-galeria-26.jpg'
            ],
            [
                'name' => 'Auriculares Sony WH-1000XM4',
                'description' => 'Auriculares inalámbricos con cancelación de ruido.',
                'stock' => 40,
                'price' => 348.00,
                'category' => 'Periféricos',
                'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_83568145?x=536&y=402&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=536&ey=402&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=536&cdy=402'
            ],
            [
                'name' => 'Estuche para Laptop HP',
                'description' => 'Estuche protector para laptops de 15.6" con material impermeable.',
                'stock' => 80,
                'price' => 19.99,
                'category' => 'Accesorios',
                'image_url' => 'https://img.soluziondigital.com/324454-large_default/hp-4u9g8aa-funda-para-portatil-mobility-de-11-6-pulgadas.jpg'
            ],
            [
                'name' => 'Soporte para Tablet',
                'description' => 'Soporte ajustable para tablet de 7" a 12.9".',
                'stock' => 200,
                'price' => 14.99,
                'category' => 'Accesorios',
                'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MP_96278969?x=536&y=402&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=536&ey=402&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=536&cdy=402'
            ],
            [
                'name' => 'iPhone 12 Pro',
                'description' => 'Smartphone de 6.1" con procesador A14, 6GB RAM y 128GB.',
                'stock' => 25,
                'price' => 1099.00,
                'category' => 'Smartphones',
                'image_url' => 'https://i.blogs.es/a8f74e/iphone-12-pro-00-08/1366_2000.jpg'
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'description' => 'Smartphone con pantalla de 6.2", Exynos 2100, 8GB RAM y 128GB.',
                'stock' => 35,
                'price' => 799.99,
                'category' => 'Smartphones',
                'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MP_133487512?x=536&y=402&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=536&ey=402&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=536&cdy=402'
            ],
            [
                'name' => 'iPad Pro 11"',
                'description' => 'Tablet de 11" con chip M1, 8GB RAM y 128GB.',
                'stock' => 40,
                'price' => 799.00,
                'category' => 'Tablets',
                'image_url' => 'https://thumb.pccomponentes.com/w-530-530/articles/39/395336/1885-apple-ipad-pro-2021-11-128gb-wifi-gris-espacial-foto.jpg'
            ],
            [
                'name' => 'Samsung Galaxy Tab S7',
                'description' => 'Tablet de 11" con Snapdragon 865+, 6GB RAM y 128GB.',
                'stock' => 30,
                'price' => 649.99,
                'category' => 'Tablets',
                'image_url' => 'https://www.muycomputer.com/wp-content/uploads/2020/08/GalaxyTabS7.jpg'
            ],
            [
                'name' => 'Placa base ASUS ROG',
                'description' => 'Placa base ATX para PC con chipset Z590.',
                'stock' => 100,
                'price' => 249.99,
                'category' => 'Componentes',
                'image_url' => 'https://m.media-amazon.com/images/I/81sare7xcNL._AC_CR0%2C0%2C0%2C0_SX480_SY360_.jpg'
            ],
            [
                'name' => 'Tarjeta gráfica NVIDIA RTX 3070',
                'description' => 'Tarjeta gráfica de 8GB GDDR6 con soporte para Ray Tracing.',
                'stock' => 20,
                'price' => 499.99,
                'category' => 'Componentes',
                'image_url' => 'https://thumb.pccomponentes.com/w-530-530/articles/51/515433/1552-gainward-geforce-rtx-3070-phoenix-8gb-gddr6.jpg'
            ],
            [
                'name' => 'Disco duro externo Seagate',
                'description' => 'Disco duro externo de 2TB con conexión USB 3.0.',
                'stock' => 150,
                'price' => 69.99,
                'category' => 'Almacenamiento',
                'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_88745014?x=320&y=320&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=320&ey=320&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=320&cdy=320'
            ],
            [
                'name' => 'SSD Kingston A2000',
                'description' => 'SSD NVMe de 500GB con velocidad de lectura de hasta 2200MB/s.',
                'stock' => 120,
                'price' => 59.99,
                'category' => 'Almacenamiento',
                'image_url' => 'https://thumb.pccomponentes.com/w-530-530/articles/22/225080/1.jpg'
            ],
            [
                'name' => 'Router Wi-Fi TP-Link Archer AX50',
                'description' => 'Router Wi-Fi 6 de doble banda, velocidad de hasta 3 Gbps.',
                'stock' => 90,
                'price' => 129.99,
                'category' => 'Redes',
                'image_url' => 'https://static.tp-link.com/Archer-AX50_01_normal_1616726600988r.jpg'
            ],
            [
                'name' => 'Switch Netgear GS308',
                'description' => 'Switch de 8 puertos Gigabit Ethernet.',
                'stock' => 150,
                'price' => 39.99,
                'category' => 'Redes',
                'image_url' => 'https://www.netgear.com/zone1/cid/fit/1024x633/to/jpg/https/www.netgear.com/es/media/gs308v3_productcarousel_hero_image_tcm174-99670.png'
            ]
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();

            if ($category) {
                $imagePath = $this->downloadImage($product['image_url'], $product['name']);

                // Crear el producto
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'stock' => $product['stock'],
                    'price' => $product['price'],
                    'category_id' => $category->id,
                    'image' => $imagePath
                ]);
            }
        }
    }

    private function downloadImage($url, $productName)
    {
        $imageContent = Http::get($url)->body();
        $imageName = strtolower(str_replace(' ', '_', $productName)) . '.jpg';
        Storage::disk('public')->put($imageName, $imageContent);

        return $imageName;
    }
}
