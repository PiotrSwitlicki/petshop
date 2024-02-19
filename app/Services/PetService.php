<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{
    public function getAllPets()
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available');
        return $response->json();
    }

    public function getPetById($id)
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/' . $id);

        if ($response->failed()) {
            return null; 
        }

        return $response->json();
    }

    public function addPet(array $data)
    {
        Http::post('https://petstore.swagger.io/v2/pet', $data);
    }

    public function updatePet($id, array $data)
    {
        // Konwersja danych do formatu JSON
        $jsonData = json_encode($data);

        // Inicjalizacja uchwytu cURL
        $ch = curl_init();

        // Ustawienie opcji żądania cURL
        curl_setopt($ch, CURLOPT_URL, "https://petstore.swagger.io/v2/pet/$id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Accept: application/json' // Dodanie nagłówka akceptacji
        ]);

        // Wykonanie żądania cURL
        $response = curl_exec($ch);

        // Sprawdzenie czy wystąpiły błędy
       dd($response); 
        if (curl_errno($ch)) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Failed to update pet: $errorMessage");
        }

        // Zamknięcie uchwytu cURL
        curl_close($ch);

        // Sprawdzenie odpowiedzi
        if ($response === false) {
            throw new \Exception("Failed to update pet: Unknown error");
        } else {
            $xml = simplexml_load_string($response);
            return $xml;
        }
    }

    public function deletePet($id)
    {
        Http::delete('https://petstore.swagger.io/v2/pet/' . $id);
    }
}