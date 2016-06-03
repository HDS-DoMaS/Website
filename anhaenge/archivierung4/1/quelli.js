// ZUFALLSGENERATOR FÜR DAS ANALYSE-ERGEBNIS DER ZOESEN-WEBSEITE

//natürliche Zufallszahl zwischen 0 und 9 generieren.
var zufall = Math.random() * 10;
zufall = Math.floor(zufall);



// Die Bezeichnung des Weibchens anhand des Zufallswertes generieren.
var bezeichnung;

switch (zufall) {
        case 0: bezeichnung = "Zombie";
                break;
        
        case 1: bezeichnung = "Hässlon";
                break;
        
        case 2: bezeichnung = "Schabracke";
                break;
        
        case 3: bezeichnung = "Bratze";
                break;
        
        case 4: bezeichnung = "Vogelscheuche";
                break;
        
        case 5: bezeichnung = "Eiserne Jungfrau";
                break;
        
        case 6: bezeichnung = "Schnalle";
                break;
        
        case 7: bezeichnung = "Puppe";
                break;
        
        case 8: bezeichnung = "Braut";
                break;
        
        case 9: bezeichnung = "Granate";
}



//// Den Zösenwert ins HTML einbinden

// ZÖSENWERT
var linkZoesenwert = document.getElementById("zoesenwert");
var linkZoesenwertHref = linkZoesenwert.getAttributeNode("href").value;

linkZoesenwert.getAttributeNode("href").value = linkZoesenwertHref + zufall;

linkZoesenwert.firstChild.firstChild.nodeValue = zufall;


// BEZEICHNUNG
var linkZoesenbezeichnung = document.getElementById("zoesenbezeichnung");
var linkZoesenbezeichnungHref = linkZoesenbezeichnung.getAttributeNode("href").value;

linkZoesenbezeichnung.getAttributeNode("href").value = linkZoesenbezeichnungHref + zufall;

linkZoesenbezeichnung.firstChild.firstChild.nodeValue = bezeichnung;


// AUDIOPLAYER
if (bezeichnung == "Hässlon") {bezeichnung = "Haesslon";}

var paragrafPlayer = document.getElementById("bisschenAbstandNachUnten");

var neuerPlayer = document.createElement("audio");
var neuerPlayerAttribut = document.createAttribute("controls");
neuerPlayer.setAttributeNode(neuerPlayerAttribut);


var neuerPlayerSource = document.createElement("source");
var neuerPlayerSourceAttribut = document.createAttribute("src");
neuerPlayerSourceAttribut.value = "audio/" + bezeichnung + ".mp3";
neuerPlayerSource.setAttributeNode(neuerPlayerSourceAttribut);


neuerPlayer.appendChild(neuerPlayerSource);

paragrafPlayer.appendChild(neuerPlayer);







