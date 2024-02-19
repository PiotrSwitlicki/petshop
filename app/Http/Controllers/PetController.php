<?php

namespace App\Http\Controllers;

use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = $this->petService->getAllPets();
        return view('pets.index', compact('pets'));
    }

    public function store(Request $request)
    {
        $this->validatePet($request);

        $this->petService->addPet($request->all());

        return redirect()->route('pets.index')->with('success', 'Pet added successfully.');
    }

    public function edit($id)
    {
        $pet = $this->petService->getPetById($id);

        if ($pet === null) {
            return redirect()->route('pets.index')->with('error', 'Pet not found.');
        }

        return view('pets.edit', ['pet' => $pet]);
    }

    public function update(Request $request, $id)
    {
        $this->validatePet($request);

        $this->petService->updatePet($id, $request->all());

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy($id)
    {
        $this->petService->deletePet($id);
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }

    protected function validatePet(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
    }
}