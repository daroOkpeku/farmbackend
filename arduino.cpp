#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "your_ssid";
const char* password = "your_password";
const char* serverUrl = "https://api.ranchidpro.com/api/engine-metrics/NGBA0000NEO0431/update";

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    Serial.print("Connecting to WiFi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("Connected!");
}

void loop() {
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;

        // Specify content type as JSON
        http.begin(serverUrl);
        http.addHeader("Content-Type", "application/json");

        // Create a JSON object for the engine metrics
        StaticJsonDocument<200> jsonDoc;
        jsonDoc["voltage"] = 12.5;
        jsonDoc["current"] = 1.2;
        jsonDoc["frequency"] = 50.0;
        jsonDoc["power"] = 100.0;
        jsonDoc["energy"] = 150.0;
        jsonDoc["runtime"] = 3600;
        jsonDoc["temperature"] = 25.0;
        jsonDoc["oil_level"] = 80;
        jsonDoc["oil_quality"] = 90;
        jsonDoc["fuel_level"] = 75;
        jsonDoc["rpm"] = 1500;
        jsonDoc["gyration"] = 120;
        jsonDoc["health_status"] = "Good";

        String jsonData;
        serializeJson(jsonDoc, jsonData);

        // Send PUT request with JSON payload
        int httpResponseCode = http.PUT(jsonData);

        if (httpResponseCode > 0) {
            String response = http.getString();
            Serial.println(httpResponseCode);
            Serial.println(response);
        } else {
            Serial.print("Error on sending PUT request: ");
            Serial.println(httpResponseCode);
        }

        http.end();
    } else {
        Serial.println("WiFi Disconnected");
    }

    delay(10000);
}
