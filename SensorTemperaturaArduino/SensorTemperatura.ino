#include "DHT.h"
#include <Ethernet.h>
#include <SPI.h>
#define DHTPIN 2
#define DHTTYPE DHT11

// Configuracion del Ethernet Shield
byte mac[] = {0xDA, 0xAD, 0xBF, 0xEF, 0xFE, 0xED}; // Direccion MAC
byte ip[] = { 192,168,8,14 }; // Direccion IP del Arduino
byte server[] = { 192,168,8,9 }; // Direccion IP del servidor
EthernetClient client; 
// Inicializa el sensor
DHT dht(DHTPIN, DHTTYPE);

void setup(){
  Serial.begin(9600);
  delay(1000);
  Serial.print("Direccion IP: ");   
  Ethernet.begin(mac, ip); // Inicializamos el Ethernet Shield
  dht.begin();
}

void loop(){
  //int chk;
  //int temp;
  //int hum;
  
  //Valida conexion a servidor
      if (client.connect(server, 80)) {
        // Obtiene la Humedad
      float temp = dht.readTemperature();
      float hum = dht.readHumidity();
        // Control de errores, valida que se obtuvieron valores para los datos medidos
      if (isnan(hum) || isnan(temp)) {
          Serial.println("Falla al leer el sensor!");
          return;
          }
      Serial.print("Sensor DHT11: ");
      Serial.print(temp);
      Serial.println("° Grados Centígrados");
      Serial.print("Humedad al ");
      Serial.print(hum);
      Serial.println("%");
  // Proceso de envio de muestras al servidor
      Serial.println("Connecting...");
      client.print("GET /arduino/controller/index.php?temp="); // Enviamos los datos por GET
      client.print(temp);
      client.print("&hum=");
      client.print(hum);
      client.println(" HTTP/1.0");
      client.println("User-Agent: Arduino 1.0");
      client.println();
      Serial.println("Conectado");
    } else {
      Serial.println("Fallo en la conexion");
    }
    if (!client.connected()) {
      Serial.println("Disconnected!");
    }
   client.stop();
    client.flush();
    delay(3600000); // Espero una hora antes de tomar otra muestra
      }
 
  

  
