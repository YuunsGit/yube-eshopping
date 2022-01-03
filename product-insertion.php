<?php

$conn = mysqli_connect("localhost", "root", "", "yube");

$tablet_arr = ["12''", "250GB", "Allwinner", "AMD", "Intel", "Apple", "iPad", "Bluetooth", "Qualcomm",
"Ethernet", "2GB", "4GB", "1TB", "256TB", "1.59 GHz", "16:10", "AMOLED", "LCD", "LED", "OLED",
"ARM", "Energy Star", "2500 mAh", "3000 mAh", "5000 mAh", "15000 mAh", "Pro", "Business",
"Art", "Pen", "Multitouch", "SD Card", "3G", "4G", "5G", "9G", "2.4 GHz", "5 GHz",  "5.8 GHz", "26 GHz", "Android"];

$display_arr = ["Tech", "High Resolution", "Curved", "Gaming", "FHD",
 "LED", "Business", "1920x1080", "23.5''", "27''", "25''", "Professional",
"Portable", "75 Hz", "Tin", "144 Hz", "19''", "Ender", "Sevinc", "15.6''", "QHD", "Full HD", "Quad HD",
"2K", "4K", "VGA", "HDMI", "Ultra Slim", "DisplayPort", "IPS", "VA", "TN", "1ms", "2ms", "4ms", "G-Sync"
,"240 Hz", "FreeSync", "QLED", "OLED", "Light Mode"];

$laptop_arr = ["AMD", "Intel", "Mediatek", "2G", "3G", "16.9''", "15.6''", "Bluetooth", "AMOLED",
"LCD", "LED", "OLED", "4GB", "8GB", "16GB", "1TB", "1.5TB", "Ethernet", "3060Ti", "HDMI",
"USB", "USB3.0", "Business", "Gaming", "Multimedia", "Personal", "Single Core", "Dual Core", "Quad Core",
"FHD", "QHD", "1920x1080", "NFC", "2K", "High Resolution", "SSD", "HDD", "Mechanical Harddrive", "Triports",
"4K", "Touchscreen"];

$mouse_arr = ["Laser", "Optical", "Notebook", "Wheel", "Wireless", "Bluetooth", "USB",
"Trackball", "Right-Handed", "Left-Handed", "Rainbow", "Metal", "Plastic", "Wood",
"Windows", "Linux", "3 Buttons", "4 Buttons", "5 Buttons", "Office", "Mac", "DOS",
"Wi-Fi", "RGB", "Gaming", "Chrome OS", "Car", "Butterfly", "Floral", "Honeycomb Shell"];

$printer_arr = ["Connor", "Copying", "Faxing", "Printing Only", "Scanning", "Photo Quality Printing",
"Color", "Monochrome", "Bluetooth", "CD-Printing", "USB", "Wireless", "Ethernet", "Flatbed", "Portable",
"Sheetfed", "Voice", "App", "10 PPM", "20 PPM", "30 PPM", "1000 PPM", "Blue", "Decal-Printing",
"Network Ready", "Mac", "Windows", "Linux", "DOS", "Red", "Green", "Space Gray", "White", "HP"];

for($i = 1; $i < 11; $i++) {
    $name = $display_arr[rand(0,count($display_arr)-1)];
    for($a = 0; $a < 8; $a++) {
        $name = $name." ".$display_arr[rand(0,count($display_arr)-1)];
    }

    $query = "INSERT INTO products (id, name, stock, price) VALUES ('display".$i."', '".$name."', '".rand(0, 20)."', '".(rand(100, 200)+0.9)."')";

    //mysqli_query($conn, $query);
}

for($i = 1; $i < 12; $i++) {
    $name = $laptop_arr[rand(0,count($laptop_arr)-1)];
    for($a = 0; $a < 8; $a++) {
        $name = $name." ".$laptop_arr[rand(0,count($laptop_arr)-1)];
    }

    $query = "INSERT INTO products (id, name, stock, price) VALUES ('laptop".$i."', '".$name."', '".rand(0, 15)."', '".(rand(200, 500)+0.9)."')";

    //mysqli_query($conn, $query);
}

for($i = 1; $i < 13; $i++) {
    $name = $mouse_arr[rand(0,count($mouse_arr)-1)];
    for($a = 0; $a < 8; $a++) {
        $name = $name." ".$mouse_arr[rand(0,count($mouse_arr)-1)];
    }

    $query = "INSERT INTO products (id, name, stock, price) VALUES ('mouse".$i."', '".$name."', '".rand(0, 40)."', '".(rand(15, 50)+0.9)."')";

    //mysqli_query($conn, $query);
}

for($i = 1; $i < 8; $i++) {
    $name = $printer_arr[rand(0,count($printer_arr)-1)];
    for($a = 0; $a < 8; $a++) {
        $name = $name." ".$printer_arr[rand(0,count($printer_arr)-1)];
    }

    $query = "INSERT INTO products (id, name, stock, price) VALUES ('printer".$i."', '".$name."', '".rand(0, 40)."', '".(rand(100, 200)+0.9)."')";

    //mysqli_query($conn, $query);
}

for($i = 1; $i < 9; $i++) {
    $name = $tablet_arr[rand(0,count($tablet_arr)-1)];
    for($a = 0; $a < 8; $a++) {
        $name = $name." ".$tablet_arr[rand(0,count($tablet_arr)-1)];
    }

    $query = "INSERT INTO products (id, name, stock, price) VALUES ('tablet".$i."', '".$name."', '".rand(0, 40)."', '".(rand(150, 450)+0.9)."')";

    //mysqli_query($conn, $query);
}

?>